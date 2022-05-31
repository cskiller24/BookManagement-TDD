<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        try {
            if(Auth::attempt($request->validated())) {
                return response()->json([
                    'message' => 'Incorrect Email or Password'
                ], ResponseCodes::HTTP_UNPROCESSABLE_ENTITY);
            }
            $user = User::query()->where('email', $request->only('email'))->first();
            Auth::login($user);

            if($user->is_admin) {
                $user->token = $user->createToken(now(), array_merge(Genre::ABILITIES))->plainTextToken;
            } else {
                $user->token = $user->createToken(now(), array_merge(Book::ABILITIES, Review::ABILITIES))->plainTextToken;
            }
            return UserResource::make($user);
        } catch (QueryException $queryException) {
            return response()->json([
                'errors' => [
                    'query' => $queryException->getMessage(),
                ]
            ], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
