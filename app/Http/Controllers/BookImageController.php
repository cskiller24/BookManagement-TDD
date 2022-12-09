<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Book $book, BookImageRequest $request): JsonResource
    {
        abort_unless(auth()->user()->tokenCan('book.images-create'), Response::HTTP_FORBIDDEN);

        $this->authorize('belongsToUser', $book);

        throw_if(
            $book->images()->count() >= 3,
            ValidationException::withMessages(['image' => 'Cannot add more than 3 images in a book'])
        );

        $path = $request->file('image')->store('', Image::DISK);

        $image = $book->images()->create([
            'path' => $path
        ]);
        return ImageResource::make($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book, Image $image): JsonResource
    {
        abort_unless(auth()->user()->tokenCan('book.images-update'), Response::HTTP_FORBIDDEN);

        $this->authorize('belongsToUser', $book);

        throw_if(
            $book->featured_image_id == $image->id,
            ValidationException::withMessages(['image' => 'The image is already a featured image'])
        );

        $book->update(['featured_image_id' => $image->id]);

        return ImageResource::make($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Image $image): Response
    {
        abort_unless(auth()->user()->tokenCan('book.images-delete'), Response::HTTP_FORBIDDEN);

        $this->authorize('belongsToUser', $book);

        throw_if(
            $book->images()->count() == 1,
            ValidationException::withMessages(['image' => 'Cannot delete the only image'])
        );

        throw_if(
            $book->featured_image_id == $image->id,
            ValidationException::withMessages(['image' => 'You cannot delete a featured image'])
        );

        Storage::disk(Image::DISK)->delete($image->path);

        $image->delete();

        return response()->noContent();
    }
}
