<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
            ->when(request('sortBy') == 'popularity', function ($builder) {
                $builder->with('sortByFavorites');
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
    public function store(Request $request)
    {
        return response('store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response('show');
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
