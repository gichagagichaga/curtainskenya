<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        [$items, $subtotal] = $this->items();

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active && $product->stock_quantity > 0, 404);

        $validated = $request->validate(['quantity' => ['nullable', 'integer', 'min:1', 'max:100']]);
        $cart = session('cart', []);
        $quantity = ($cart[$product->id] ?? 0) + ($validated['quantity'] ?? 1);

        if ($quantity > $product->stock_quantity) {
            throw ValidationException::withMessages(['quantity' => "Only {$product->stock_quantity} available for {$product->name}."]);
        }

        $cart[$product->id] = $quantity;
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('status', "{$product->name} was added to your bag.");
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:100']]);
        $cart = session('cart', []);

        abort_unless(array_key_exists($product->id, $cart), 404);

        if (! $product->is_active || $validated['quantity'] > $product->stock_quantity) {
            throw ValidationException::withMessages(['quantity' => "Only {$product->stock_quantity} available for {$product->name}."]);
        }

        $cart[$product->id] = $validated['quantity'];
        session(['cart' => $cart]);

        return back()->with('status', 'Your bag was updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('status', 'Item removed from your bag.');
    }

    /** @return array{0: Collection<int, array{product: Product, quantity: int, unit_price: float, line_total: float}>, 1: float} */
    public function items(): array
    {
        $cart = session('cart', []);
        $products = Product::query()->with('images')->whereKey(array_keys($cart))->where('is_active', true)->get()->keyBy('id');

        $items = collect($cart)->map(function (int $quantity, int|string $productId) use ($products): ?array {
            $product = $products->get($productId);

            if (! $product) {
                return null;
            }

            $quantity = min($quantity, $product->stock_quantity);
            $unitPrice = (float) ($product->sale_price ?: $product->price);

            return ['product' => $product, 'quantity' => $quantity, 'unit_price' => $unitPrice, 'line_total' => round($unitPrice * $quantity, 2)];
        })->filter()->values();

        return [$items, round($items->sum('line_total'), 2)];
    }
}
