<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResource
    {
        $books = Book::query()
            ->when(request('sortBy') == 'author', function ($builder) {
                $builder->orderByRaw('COUNT(*) OVER (PARTITION BY user_id) DESC');
            })
            ->when(request('sortBy') == 'title', function ($builder) {
                $builder->orderBy('title');
            })
            ->when(request('sortBy') == 'favorites', function ($builder) {
                $builder->withCount('favorites')->orderByDesc('favorites_count');
            })
            ->when(request('sortBy') == 'reviews', function ($builder) {
                $builder->withCount('reviews')->orderByDesc('reviews_count');
            })
            ->when(request('sortBy') == 'recent', function ($builder) {
                $builder->latest();
            })
            ->paginate(20);
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request): JsonResource
    {
        abort_unless(auth()->user()->tokenCan('office.create'), Response::HTTP_FORBIDDEN);

        $credentials = $request->validated();
        $credentials['user_id'] = auth()->id();
        return BookResource::make(Book::create($credentials));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response('delete');
    }
}
