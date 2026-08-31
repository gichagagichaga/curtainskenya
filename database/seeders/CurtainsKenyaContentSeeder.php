<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CurtainsKenyaContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Window Measuring Visit', 'slug' => 'window-measuring-visit', 'short_description' => 'Accurate on-site measurements before you order curtains, sheers or blinds.', 'description' => 'We assess window dimensions, fixing points, light direction and how the room is used. You receive practical recommendations and measurements ready for a clear quotation.', 'sort_order' => 1],
            ['name' => 'Curtain and Blind Installation', 'slug' => 'curtain-blind-installation', 'short_description' => 'Professional fitting for tracks, rods, curtains and blinds.', 'description' => 'Our team checks placement, installs the selected hardware and hangs or tests the finished window treatment so it opens, closes and falls correctly.', 'sort_order' => 2],
            ['name' => 'Fabric and Styling Consultation', 'slug' => 'fabric-styling-consultation', 'short_description' => 'Guidance on colour, lining, texture and practical fabric performance.', 'description' => 'Bring room photos, measurements or plans and we will help narrow the choices for privacy, heat, daylight, maintenance and your preferred interior style.', 'sort_order' => 3],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], [...$service, 'is_active' => true]);
        }

        $author = User::query()->firstOrCreate(
            ['email' => 'editor@curtainskenya.com'],
            ['name' => 'Curtains Kenya Editorial Team', 'password' => Hash::make('change-me-before-production'), 'role' => 'content_manager', 'email_verified_at' => now()],
        );

        $category = BlogCategory::query()->updateOrCreate(
            ['slug' => 'window-planning'],
            ['name' => 'Window Planning', 'description' => 'Kenya-specific guidance for choosing, measuring and caring for window treatments.', 'seo_title' => 'Curtain and Blind Planning Guides | Curtains Kenya', 'meta_description' => 'Practical advice for curtains, blinds, measurements, fabrics and installation in Kenyan homes.', 'noindex' => false, 'is_active' => true],
        );

        Post::query()->updateOrCreate(
            ['slug' => 'choosing-curtains-for-nairobi-sunlight-and-privacy'],
            [
                'author_id' => $author->id,
                'blog_category_id' => $category->id,
                'title' => 'Choosing Curtains for Nairobi Sunlight and Privacy',
                'excerpt' => 'A room-by-room way to balance glare, privacy, airflow and fabric care before ordering curtains.',
                'content' => "Start with the direction each window faces and the times when glare or privacy matter most. Bedrooms often benefit from a lined layer, while living rooms can combine a sheer with a heavier curtain. Measure beyond the glass so the finished treatment can stack neatly and reduce light gaps.\n\nBefore choosing colour, ask how often the fabric will be handled, whether dust is a concern and if the room needs easy washing. A measuring visit helps turn those practical answers into the right width, drop and fixing method.",
                'status' => 'published',
                'published_at' => now()->subDay(),
                'reading_time' => 4,
                'seo_title' => 'How to Choose Curtains for Nairobi Homes | Curtains Kenya',
                'meta_description' => 'Plan curtains for Nairobi sunlight, privacy and room use with practical advice on lining, layers, measurements and fabric care.',
                'noindex' => false,
            ],
        );
    }
}
