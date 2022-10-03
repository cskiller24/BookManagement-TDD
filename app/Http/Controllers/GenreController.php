<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GenreController extends Controller
{
    public function index()
    {
        return response('genres');
    }

    public function store(Request $request): JsonResource
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:Fiction,Non-Fiction',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,svg'
        ]);

        $path = $request->file('image')->storePublicly(Image::STORING_PATH);
        $path = str_replace(Image::STORING_PATH.'/', '', $path);

        $genre = Genre::query()->create($request->only(['title', 'type', 'description']));

        $genre->image()->create(['path' => $path]);

        return GenreResource::make($genre);
    }

    public function update(Genre $genre, Request $request)
    {
        $request->validate([
            'title' => 'sometimes|string',
            'type' => 'sometimes|in:Fiction,Non-Fiction',
            'description' => 'sometimes|string',
            'image' => 'mimes:png,jpg,svg'
        ]);

        if($request->has('title') && $request->title !== null) {
            $genre->title = $request->title;
        }

        if($request->has('type') && $request->type !== null) {
            $genre->type = $request->type;
        }

        if($request->has('description') && $request->description !== null) {
            $genre->description = $request->description;
        }

        if($request->hasFile('image')) {
            Storage::delete($genre->image()->path);
        }

    }
}
