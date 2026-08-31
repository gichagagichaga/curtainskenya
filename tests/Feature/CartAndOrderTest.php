<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

function cartProduct(): Product
{
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);

    return Product::create(['category_id' => $category->id, 'name' => 'Linen Curtain', 'slug' => 'linen-curtain', 'price' => 6500, 'stock_quantity' => 4, 'is_active' => true]);
}

test('a customer can add a product to their bag', function () {
    $product = cartProduct();

    $this->post(route('cart.store', $product), ['quantity' => 2])
        ->assertRedirect(route('cart.index'));

    $this->get(route('cart.index'))
        ->assertOk()
        ->assertSee('Linen Curtain')
        ->assertSee('13,000.00');
});

test('checkout creates an order and reduces stock', function () {
    $product = cartProduct();
    $this->withSession(['cart' => [$product->id => 2]])
        ->post(route('checkout.store'), [
            'customer_name' => 'Jane Wanjiku', 'customer_email' => 'jane@example.com', 'customer_phone' => '+254720373737',
            'delivery_county' => 'Nairobi', 'delivery_address' => 'Kilimani, Nairobi',
        ])->assertRedirect();

    $order = Order::firstOrFail();
    $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'pending', 'total' => 13000]);
    $this->assertDatabaseHas('order_items', ['order_id' => $order->id, 'product_id' => $product->id, 'quantity' => 2]);
    expect($product->fresh()->stock_quantity)->toBe(2);
});

test('guests cannot access order management and admins can update an order status', function () {
    $product = cartProduct();
    $order = Order::create(['order_number' => 'CK-TEST-001', 'status' => 'pending', 'customer_name' => 'Jane Wanjiku', 'customer_email' => 'jane@example.com', 'customer_phone' => '+254720373737', 'delivery_county' => 'Nairobi', 'delivery_address' => 'Kilimani', 'subtotal' => 6500, 'total' => 6500]);

    $this->get(route('admin.orders.index'))->assertRedirect(route('login'));

    $administrator = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);

    $this->actingAs($administrator)->patch(route('admin.orders.update', $order), ['status' => 'processing'])->assertSessionHas('status');

    expect($order->fresh()->status)->toBe('processing');
});
