<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book): JsonResource
    {
        return BookResource::make($book->load('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book, ReviewRequest $request): JsonResource
    {
        abort_unless(auth()->user()->tokenCan('review.create'), Response::HTTP_FORBIDDEN);

        $this->authorize('doesNotBelongToUser', $book);

        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $review = $book->reviews()->create($data);

        return ReviewResource::make($review);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Review $review): JsonResource
    {
        return ReviewResource::make($review->load('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book, Review $review, ReviewRequest $request): JsonResource
    {
        abort_unless(auth()->user()->tokenCan('review.update'), Response::HTTP_FORBIDDEN);

        $this->authorize('belongsToUser', $book);

        $review->update($request->validated());

        return ReviewResource::make($review->load('book'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Review $review): Response
    {
        abort_unless(auth()->user()->tokenCan('review.delete'), Response::HTTP_FORBIDDEN);

        $this->authorize('belongsToUser', $book);

        $review->delete();

        return response()->noContent();
    }

    public function userIndex(): JsonResource
    {
        $reviews = User::with(['reviews'])->where('id', auth()->id())->first();
        return UserResource::make($reviews);
    }
}