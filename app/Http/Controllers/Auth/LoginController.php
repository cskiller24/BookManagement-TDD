<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        try {
            $auth = Auth::attempt($request->validated());
            if(!$auth) {
                return response()->json([
                    'message' => 'Incorrect Email or Password'
                ], ResponseCodes::HTTP_UNPROCESSABLE_ENTITY);
            }
            $user = User::query()->where('email', $request->only('email'))->first();
            $user->token = $user->createToken(now())->plainTextToken;

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
