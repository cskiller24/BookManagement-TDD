<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = User::query()->create($request->validated());
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
