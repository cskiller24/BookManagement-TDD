<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookFavoriteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book): JsonResource
    {
        abort_unless(
            auth()->user()->tokenCan('book.favorites-create'),
            Response::HTTP_FORBIDDEN
        );

        auth()->user()->favorites()->attach($book->id);

        return BookResource::make($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): Response
    {
        abort_unless(
            auth()->user()->tokenCan('book.favorites-delete'),
            Response::HTTP_FORBIDDEN
        );

        auth()->user()->favorites()->detach($book->id);

        return response()->noContent();
    }
}