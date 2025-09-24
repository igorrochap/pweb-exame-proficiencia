<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\Authenticate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    public function login(Request $request, Authenticate $action): JsonResponse
    {
        $token = $action->handle($request->string('email'), $request->string('password'));
        if (is_null($token)) {
            return response()->json(['message' => 'Invalid email or password'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($token)->cookie(
            'token',
            $token->access_token,
            $token->expiration,
            '/',     // path
            null,    // domain
            false,   // secure
            true,    // httpOnly
            false,   // raw
            'Strict' // sameSite
        );
    }
}
