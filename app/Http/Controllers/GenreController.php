<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class GenreController extends Controller
{
    public function index(): JsonResource
    {
        $genre = Genre::with('image')
        ->when(request('type') == 'fiction', function(EloquentBuilder $query) {
            $query->where('type', '=', 'Fiction');
        })
        ->when(request('type') == 'non-fiction', function (EloquentBuilder $query) {
            $query->where('type', '=', 'Non-Fiction');
        })
        ->get();
        return GenreResource::collection(
            $genre
        );
    }

    public function show($id)
    {
        $genre = Genre::query()->find($id);
        $genre->books = Book::query()->where('genre_id', '=', $genre->id)->latest()->with(['images', 'genre', 'user', 'featuredImage'])->get();

        return GenreResource::make($genre);
    }

    public function store(Request $request): JsonResource
    {
        abort_unless(Auth::user()->tokenCan('genre.create'), HttpFoundationResponse::HTTP_FORBIDDEN);

        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:Fiction,Non-Fiction',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,svg'
        ]);

        $path = $request->file('image')->storePublicly(Image::STORING_PATH);
        $path = str_replace(Image::STORING_PATH.'/', '', $path);

        $genre = Genre::query()->create($request->only(['title', 'type', 'description']));

        $genre->image()->updateOrCreate(['path' => $path]);

        return GenreResource::make($genre->load('image'));
    }

    public function update(Genre $genre, Request $request)
    {
        abort_unless(Auth::user()->tokenCan('genre.update'), HttpFoundationResponse::HTTP_FORBIDDEN);

        $request->validate([
            'title' => 'sometimes|string',
            'type' => 'sometimes|in:Fiction,Non-Fiction',
            'description' => 'sometimes|string',
            'image' => 'sometimes|image'
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
            Storage::disk('public-images')->delete($genre->image->path);

            $path = $request->file('image')->storePublicly(Image::STORING_PATH);
            $path = str_replace(Image::STORING_PATH.'/', '', $path);

            $genre->image->update(['path' => $path]);
        }

        $genre->save();

        $genre->refresh();

        return GenreResource::make($genre->load('image'));
    }

    public function destroy(Genre $genre): Response
    {
        Storage::delete($genre->image->path);

        $genre->delete();

        return response()->noContent();
    }
}
