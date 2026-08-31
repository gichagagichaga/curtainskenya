<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'visibility' => ['nullable', Rule::in(['active', 'hidden'])],
            'stock' => ['nullable', Rule::in(['in_stock', 'low_stock', 'out_of_stock'])],
            'sort' => ['nullable', Rule::in(['newest', 'oldest', 'name_asc', 'name_desc', 'price_low', 'price_high', 'stock_low', 'stock_high'])],
        ]);

        $products = Product::query()
            ->with(['category', 'images'])
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, fn ($query, int $category): mixed => $query->where('category_id', $category))
            ->when($filters['visibility'] ?? null, fn ($query, string $visibility): mixed => $query->where('is_active', $visibility === 'active'))
            ->when($filters['stock'] ?? null, function ($query, string $stock): void {
                match ($stock) {
                    'in_stock' => $query->where('stock_quantity', '>', 10),
                    'low_stock' => $query->whereBetween('stock_quantity', [1, 10]),
                    'out_of_stock' => $query->where('stock_quantity', 0),
                };
            });

        match ($filters['sort'] ?? 'newest') {
            'oldest' => $products->oldest(),
            'name_asc' => $products->orderBy('name'),
            'name_desc' => $products->orderByDesc('name'),
            'price_low' => $products->orderByRaw('COALESCE(sale_price, price) asc'),
            'price_high' => $products->orderByRaw('COALESCE(sale_price, price) desc'),
            'stock_low' => $products->orderBy('stock_quantity'),
            'stock_high' => $products->orderByDesc('stock_quantity'),
            default => $products->latest(),
        };

        $products = $products->paginate(15)->withQueryString();
        $filterCategories = Category::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.products.index', compact('products', 'filterCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => $this->categories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = DB::transaction(function () use ($request): Product {
            $product = Product::create($this->productData($request));

            $this->storeImages($product, $request->file('images', []), $request->input('alt_texts', []));

            return $product;
        });

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('status', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Product $product): View
    {
        $product->load('images');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $this->categories(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        DB::transaction(function () use ($request, $product): void {
            $product->update($this->productData($request, $product));

            $this->storeImages($product, $request->file('images', []), $request->input('alt_texts', []));
        });

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('status', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $imagePaths = $product->images()->pluck('image_path')->all();

        DB::transaction(fn () => $product->delete());

        Storage::disk('public')->delete($imagePaths);

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Product deleted successfully.');
    }

    public function destroyImage(Product $product, ProductImage $image): RedirectResponse
    {
        abort_unless($image->product_id === $product->id, 404);

        $imagePath = $image->image_path;
        $image->delete();

        Storage::disk('public')->delete($imagePath);

        return back()->with('status', 'Product image deleted successfully.');
    }

    public function updateStock(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'stock_quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $product->update($validated);

        return back()->with('status', "Stock updated for {$product->name}.");
    }

    /**
     * @return array<int, Category>
     */
    private function categories(): array
    {
        return Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function productData(StoreProductRequest|UpdateProductRequest $request, ?Product $product = null): array
    {
        $data = $request->safe()->except(['images', 'alt_texts', 'is_featured', 'is_active']);
        $data['slug'] = $this->uniqueSlug($data['name'], $product);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    /**
     * @param  array<int, UploadedFile>  $images
     * @param  array<int, string|null>  $altTexts
     */
    private function storeImages(Product $product, array $images, array $altTexts): void
    {
        $sortOrder = (int) $product->images()->max('sort_order') + 1;

        foreach ($images as $index => $image) {
            $product->images()->create([
                'image_path' => $image->store('products', 'public'),
                'alt_text' => $altTexts[$index] ?? null,
                'sort_order' => $sortOrder++,
            ]);
        }
    }

    private function uniqueSlug(string $name, ?Product $product = null): string
    {
        $baseSlug = Str::slug($name) ?: 'product';
        $slug = $baseSlug;
        $suffix = 2;

        while (Product::query()
            ->where('slug', $slug)
            ->when($product, fn ($query) => $query->whereKeyNot($product->id))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
