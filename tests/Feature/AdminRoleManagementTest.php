<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('super admins can create a staff administrator with a focused role', function () {
    $superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);

    $this->actingAs($superAdmin)->post(route('admin.users.store'), [
        'name' => 'Order Staff',
        'email' => 'orders@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => User::ROLE_ORDERS_MANAGER,
    ])->assertSessionHas('status');

    $staff = User::where('email', 'orders@example.com')->firstOrFail();
    expect($staff->role)->toBe(User::ROLE_ORDERS_MANAGER);
    expect(Hash::check('password', $staff->password))->toBeTrue();
});

test('orders managers cannot access product administration', function () {
    $ordersManager = User::factory()->create(['role' => User::ROLE_ORDERS_MANAGER]);

    $this->actingAs($ordersManager)->get(route('admin.products.index'))->assertForbidden();
});

test('super admins can change an administrators role', function () {
    $superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);
    $staff = User::factory()->create(['role' => User::ROLE_CUSTOMER_SERVICE]);

    $this->actingAs($superAdmin)->patch(route('admin.users.update', $staff), ['role' => User::ROLE_CONTENT_MANAGER])
        ->assertSessionHas('status');

    expect($staff->fresh()->role)->toBe(User::ROLE_CONTENT_MANAGER);
});
