<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $credentials['password'] = Hash::make($credentials['password']);
        try {
            $user = User::query()->create($credentials);
            return UserResource::make($user);
        } catch (QueryException $queryException) {
            return response()->json([
                'errors' => [
                    'query' => $queryException->getMessage(),
                ]
            ], 500);
        }
    }
}
