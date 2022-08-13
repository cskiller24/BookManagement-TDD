<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $credentials['password'] = Hash::make($credentials['password']);
        try {
            $user = User::query()->create($credentials);

            $token = $user->createToken(now(), array_merge(Review::ABILITIES, Book::ABILITIES))->plainTextToken;

            event(new Registered($user));

            $cookie = cookie('auth', $token, 60);

            return response()->json(['data' => UserResource::make($user)], ResponseCodes::HTTP_CREATED)->withCookie($cookie);
        } catch (QueryException $queryException) {
            return response()->json([
                'errors' => [
                    'query' => $queryException->getMessage(),
                ]
            ], 500);
        }
    }
}
