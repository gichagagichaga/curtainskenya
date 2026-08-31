<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StoryController extends Controller
{
    public function edit(): View
    {
        return view('admin.story.edit', ['story' => Story::query()->first()]);
    }

    public function update(UpdateStoryRequest $request): RedirectResponse
    {
        $story = Story::query()->first() ?? new Story;
        $oldImage = $story->image;
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('story', 'public');
        }

        $story->fill($data)->save();

        if ($request->hasFile('image') && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.story.edit')->with('status', 'Your story has been updated.');
    }
}
