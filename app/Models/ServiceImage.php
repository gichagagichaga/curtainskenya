<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    protected $fillable = ['service_id', 'image_path', 'sort_order'];

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
