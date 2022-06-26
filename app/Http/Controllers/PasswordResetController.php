<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $request->validate(['email' => 'email|required|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message', 'Successfully sent password reset email'])
            : response()->json(['message' => 'Something went wrong, try again'], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function verify(Request $request, $token): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $credentials['token'] = $token;

        $status = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Successfully reset password'])
            : response()->json(['message' => 'Something went wrong, try again', 'errors' => [__($status)]], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
