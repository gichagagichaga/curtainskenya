<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['customer_name', 'location', 'rating', 'review', 'is_published', 'sort_order'];

    protected function casts(): array
    {
        return ['rating' => 'integer', 'is_published' => 'boolean', 'sort_order' => 'integer'];
    }
}
