<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\Authenticate;
use App\Contracts\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Support\JwtWrapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
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

    public function user(Request $request, UserRepository $userRepository): JsonResponse
    {
        $userID = JwtWrapper::getUserID($request->cookie('token'));
        $loggedUser = $userRepository->findByID($userID);

        return $this->success($loggedUser);
    }

    public function logout(): JsonResponse
    {
        return $this->success('Logged out')->cookie(
            'token',
            null,
            -1,
            '/',
            null,
            false,
            true
        );
    }
}
