<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        try {
            $auth = Auth::attempt($request->validated());
            if(!$auth) {
                return response()->json([
                    'message' => 'Incorrect Email or Password'
                ], 401);
            }
            $user = User::query()->where('email', $request->only('email'))->first();
            $token = $user->createToken(now())->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } catch (QueryException $queryException) {
            return response()->json([
                'errors' => [
                    'query' => $queryException->getMessage(),
                ]
            ], 500);
        }
    }
}
