<?php

namespace App\Support;

use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class BlogContent
{
    public static function prepareForStorage(string $content): string
    {
        return self::containsHtml($content)
            ? Purifier::clean($content, 'blog')
            : $content;
    }

    public static function toEditorHtml(string $content): string
    {
        if (self::containsHtml($content)) {
            return Purifier::clean($content, 'blog');
        }

        return Str::markdown($content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    public static function render(string $content): string
    {
        return self::toEditorHtml($content);
    }

    private static function containsHtml(string $content): bool
    {
        return preg_match('/<(p|h[1-6]|ul|ol|blockquote|table|figure|img|iframe|pre|hr)\b/i', $content) === 1;
    }
}
