<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class VerifyEmailController extends Controller
{
    public function verify(Request $request): JsonResponse
    {
        $user = User::query()->find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified'], ResponseAlias::HTTP_PERMANENTLY_REDIRECT);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['message' => 'Email Verified'], ResponseAlias::HTTP_PERMANENTLY_REDIRECT);
    }

    public function resend(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent'], ResponseAlias::HTTP_OK);
    }
}
