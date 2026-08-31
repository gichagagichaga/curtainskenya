<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('blog_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedSmallInteger('reading_time')->default(1);
            $table->string('seo_title')->nullable();
            $table->string('meta_description', 180)->nullable();
            $table->text('seo_keywords')->nullable();
            $table->string('canonical_url')->nullable()->unique();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('noindex')->default(false);
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['blog_category_id', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
