<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'responded_at',
    ];

    protected function casts(): array
    {
        return ['responded_at' => 'datetime'];
    }
}
