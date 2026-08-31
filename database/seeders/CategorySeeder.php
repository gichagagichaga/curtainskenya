<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Curtains',
                'description' => 'Ready-made and made-to-measure curtain options for apartments, family homes, offices and hospitality spaces in Kenya.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Blinds',
                'description' => 'Roller, vertical and practical light-control blinds selected for Kenyan homes and workplaces.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bednets',
                'description' => 'Protective and decorative mosquito nets sized for children’s rooms, guest rooms and everyday bedrooms.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Bedding',
                'description' => 'Breathable sheets, duvet sets and bedroom layers for warm nights and cooler highland mornings.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Seat Covers',
                'description' => 'Tailored covers that refresh sofas, dining seats, office chairs and vehicle interiors.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Toiletry',
                'description' => 'Absorbent towels, bath mats and useful textile essentials for home and hospitality use.',
                'sort_order' => 6,
            ],
            [
                'name' => 'Fabrics',
                'description' => 'Curtain, upholstery and multipurpose fabrics available for custom interior projects.',
                'sort_order' => 7,
            ],
            [
                'name' => 'Accessories',
                'description' => 'Tracks, rods, tiebacks and finishing pieces that complete a reliable window installation.',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ]
            );
        }
    }
}
