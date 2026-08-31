<?php

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('active services have a public quotation page', function () {
    $service = Service::query()->create([
        'name' => 'Custom Curtain Making',
        'slug' => 'custom-curtain-making',
        'short_description' => 'Made to fit your home.',
        'description' => 'We measure, make, and install curtains for your space.',
        'is_active' => true,
    ]);

    $this->get(route('services.show', $service))
        ->assertOk()
        ->assertSee('Custom Curtain Making')
        ->assertSee('Request a quotation');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Services for every finishing touch.')
        ->assertSee('Custom Curtain Making');
});

test('hidden services are not publicly accessible', function () {
    $service = Service::query()->create([
        'name' => 'Private Service',
        'slug' => 'private-service',
        'description' => 'Not public yet.',
        'is_active' => false,
    ]);

    $this->get(route('services.show', $service))->assertNotFound();
});

test('a visitor can send a quotation request', function () {
    $service = Service::query()->create([
        'name' => 'Interior Consultation',
        'slug' => 'interior-consultation',
        'description' => 'Advice for your home.',
        'is_active' => true,
    ]);

    $this->post(route('services.quote', $service), [
        'name' => 'Amina Wanjiku',
        'email' => 'amina@example.com',
        'phone' => '+254720000000',
        'message' => 'Please quote for curtains in my living room.',
    ])->assertRedirect();

    $this->assertDatabaseHas(ContactMessage::class, [
        'email' => 'amina@example.com',
        'subject' => 'Quotation request: Interior Consultation',
    ]);
});

test('a content manager can create a service', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->post(route('admin.services.store'), [
        'name' => 'Professional Installation',
        'short_description' => 'Installed by our experienced team.',
        'description' => 'We handle the full installation process from planning to finishing.',
        'images' => [
            UploadedFile::fake()->image('installation-one.jpg', 1600, 900),
            UploadedFile::fake()->image('installation-two.jpg', 1600, 900),
        ],
        'sort_order' => 1,
        'is_active' => true,
    ])->assertRedirect();

    $this->assertDatabaseHas(Service::class, [
        'name' => 'Professional Installation',
        'slug' => 'professional-installation',
        'is_active' => true,
    ]);

    $service = Service::query()->where('name', 'Professional Installation')->firstOrFail();
    expect($service->images)->toHaveCount(2);
    Storage::disk('public')->assertExists($service->images->first()->image_path);
    expect(ServiceImage::query()->where('service_id', $service->id)->count())->toBe(2);
});
