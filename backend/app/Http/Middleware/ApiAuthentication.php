<?php

namespace App\Http\Middleware;

use App\Exceptions\TokenDoesntExistsException;
use App\Validations\ApiToken\ExpiredToken;
use App\Validations\ApiToken\InvalidToken;
use App\Validations\ApiToken\TokenNotExists;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $this->getToken($request);
            $payload = JWT::decode($token, new Key(config('jwt.key'), 'HS256'));
            return $next($request);
        } catch (\Exception $exception) {
            $validationChain = new TokenNotExists();
            $validationChain->add(new InvalidToken())->add(new ExpiredToken());
            return $validationChain->handle($exception);
        }
    }

    /**
     * @throws TokenDoesntExistsException
     */
    public function getToken(Request $request): string
    {
        $token = $request->cookie('token');
        if (is_null($token)) {
            throw new TokenDoesntExistsException();
        }
        return $token;
    }
}
