<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UploadedImage
{
    public static function store(UploadedFile $file, string $directory): string
    {
        $name = $file->getClientOriginalName();
        if (preg_match('/[\x00-\x1f\\\\\/]/', $name) || ! in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif', 'bmp'], true)) {
            throw ValidationException::withMessages(['image' => 'Use an image filename ending in JPG, PNG, WebP, GIF, AVIF or BMP.']);
        }

        return $file->storeAs($directory.'/'.Str::uuid(), $name, 'public');
    }
}
