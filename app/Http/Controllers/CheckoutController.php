<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(CartController $cartController): View|RedirectResponse
    {
        [$items, $subtotal] = $cartController->items();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Your bag is empty. Add a product before checking out.');
        }

        return view('checkout.show', compact('items', 'subtotal'));
    }

    public function store(StoreCheckoutRequest $request): RedirectResponse
    {
        $cart = session('cart', []);

        if ($cart === []) {
            return redirect()->route('cart.index')->with('status', 'Your bag is empty. Add a product before checking out.');
        }

        $order = DB::transaction(function () use ($cart, $request): Order {
            $products = Product::query()->whereKey(array_keys($cart))->lockForUpdate()->get()->keyBy('id');

            $lines = collect($cart)->map(function (int $quantity, int|string $productId) use ($products): array {
                $product = $products->get($productId);

                if (! $product || ! $product->is_active || $quantity > $product->stock_quantity) {
                    throw ValidationException::withMessages(['cart' => 'One or more items are no longer available in the requested quantity. Please review your bag.']);
                }

                $unitPrice = (float) ($product->sale_price ?: $product->price);

                return compact('product', 'quantity', 'unitPrice') + ['line_total' => round($unitPrice * $quantity, 2)];
            });

            $subtotal = round($lines->sum('line_total'), 2);
            $order = Order::create([...$request->validated(), 'order_number' => 'CK-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)), 'status' => 'pending', 'subtotal' => $subtotal, 'total' => $subtotal]);

            foreach ($lines as $line) {
                $order->items()->create(['product_id' => $line['product']->id, 'product_name' => $line['product']->name, 'product_sku' => $line['product']->sku, 'unit_price' => $line['unitPrice'], 'quantity' => $line['quantity'], 'line_total' => $line['line_total']]);
                $line['product']->decrement('stock_quantity', $line['quantity']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.success', $order)->with('status', 'Your order has been received.');
    }

    public function success(Order $order): View
    {
        return view('checkout.success', compact('order'));
    }
}
