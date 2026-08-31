<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\View\View;

class StoryController extends Controller
{
    public function __invoke(): View
    {
        return view('story', ['story' => Story::query()->first()]);
    }
}
