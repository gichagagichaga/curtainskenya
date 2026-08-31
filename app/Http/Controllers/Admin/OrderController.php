<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->with('items')->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function update(UpdateOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return back()->with('status', "Order {$order->order_number} updated.");
    }
}
