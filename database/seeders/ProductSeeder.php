<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Curtains',
                'name' => 'Nairobi Nightfall Blackout Curtains',
                'sku' => 'CK-CUR-001',
                'short_description' => 'Room-darkening curtains for bedrooms, media rooms and sunny living spaces.',
                'description' => 'A substantial lined curtain designed to soften outside light, improve privacy and give wide Kenyan windows a clean, tailored finish.',
                'price' => 6500,
                'sale_price' => null,
                'stock_quantity' => 20,
                'is_featured' => true,
            ],
            [
                'category' => 'Curtains',
                'name' => 'Diani Breeze Sheer Curtains',
                'sku' => 'CK-CUR-002',
                'short_description' => 'Airy sheers that filter bright daylight without closing the room in.',
                'description' => 'A lightweight voile layer for living and dining rooms where you want soft daylight, movement and daytime screening.',
                'price' => 4500,
                'sale_price' => null,
                'stock_quantity' => 25,
                'is_featured' => true,
            ],
            [
                'category' => 'Blinds',
                'name' => 'Karura Light-Control Roller Blind',
                'sku' => 'CK-BLI-001',
                'short_description' => 'A neat roller blind for compact windows, workspaces and contemporary rooms.',
                'description' => 'A low-profile blind that makes daily glare and privacy easy to manage, measured to suit home or office windows.',
                'price' => 3500,
                'sale_price' => null,
                'stock_quantity' => 30,
                'is_featured' => true,
            ],
            [
                'category' => 'Bedding',
                'name' => 'Limuru Cotton Bedding Set',
                'sku' => 'CK-BED-001',
                'short_description' => 'A breathable cotton bedding set made for comfortable everyday layering.',
                'description' => 'Soft, easy-care cotton bedding with a calm finish that works through warm seasons and cooler nights.',
                'price' => 8500,
                'sale_price' => 7500,
                'stock_quantity' => 15,
                'is_featured' => true,
            ],
            [
                'category' => 'Bednets',
                'name' => 'Coastal Canopy Bednet',
                'sku' => 'CK-BNT-001',
                'short_description' => 'A protective mosquito net with a graceful canopy-style drape.',
                'description' => 'Fine netting and generous coverage create a practical sleeping barrier with a relaxed decorative profile.',
                'price' => 4000,
                'sale_price' => null,
                'stock_quantity' => 18,
                'is_featured' => true,
            ],
            [
                'category' => 'Seat Covers',
                'name' => 'Made-to-Fit Sofa Seat Covers',
                'sku' => 'CK-SEA-001',
                'short_description' => 'Tailored covers that protect and refresh frequently used seating.',
                'description' => 'Measured covers made in practical furnishing fabrics, with colour and texture options to suit your room.',
                'price' => 5500,
                'sale_price' => null,
                'stock_quantity' => 10,
                'is_featured' => false,
            ],
            [
                'category' => 'Fabrics',
                'name' => 'Rift Weave Furnishing Fabric',
                'sku' => 'CK-FAB-001',
                'short_description' => 'A versatile textured fabric for curtains, cushions and light upholstery.',
                'description' => 'A durable woven furnishing cloth sold for custom projects where texture, repeatable colour and easy coordination matter.',
                'price' => 1200,
                'sale_price' => null,
                'stock_quantity' => 50,
                'is_featured' => true,
            ],
            [
                'category' => 'Toiletry',
                'name' => 'Mara Bath Textile Set',
                'sku' => 'CK-TOL-001',
                'short_description' => 'Coordinated towels and bath textiles for everyday use or guest rooms.',
                'description' => 'A practical set of absorbent bathroom textiles selected for dependable daily use and simple laundering.',
                'price' => 3000,
                'sale_price' => null,
                'stock_quantity' => 20,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();

            if (! $category) {
                continue;
            }

            Product::updateOrCreate(
                ['sku' => $data['sku']],
                [
                    'category_id' => $category->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                    'short_description' => $data['short_description'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'sale_price' => $data['sale_price'],
                    'stock_quantity' => $data['stock_quantity'],
                    'is_featured' => $data['is_featured'],
                    'is_active' => true,
                ]
            );
        }
    }
}
