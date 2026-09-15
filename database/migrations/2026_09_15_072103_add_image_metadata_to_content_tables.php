<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const COLUMNS = [
        'categories' => ['image_alt', 'image_title', 'image_caption'],
        'clients' => ['image_alt', 'image_title', 'image_caption'],
        'stories' => ['image_title', 'image_caption'],
        'posts' => ['featured_image_title', 'featured_image_caption'],
        'product_images' => ['image_title', 'image_caption'],
        'service_images' => ['alt_text', 'image_title', 'image_caption'],
    ];

    public function up(): void
    {
        foreach (self::COLUMNS as $name => $columns) {
            Schema::table($name, function (Blueprint $table) use ($columns): void {
                foreach ($columns as $column) {
                    $table->string($column)->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        foreach (self::COLUMNS as $name => $columns) {
            Schema::table($name, fn (Blueprint $table) => $table->dropColumn($columns));
        }
    }
};
