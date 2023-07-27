<?php

namespace App\Http\Middleware;

use App\Http\Resources\UnauthorizedResponse;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * https://www.jstoolset.com/jwt
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            if ($e instanceof UserNotDefinedException) {
                return (new UnauthorizedResponse(['error' => 'Unauthorized']))->response();
            } elseif ($e instanceof TokenExpiredException) {
                return (new UnauthorizedResponse(['error' => 'Unauthorized: Token has expired.']))->response();
            } elseif ($e instanceof TokenInvalidException) {
                return (new UnauthorizedResponse(['error' => 'Unauthorized: Invalid authorization token.']))->response();
            } elseif ($e instanceof JWTException) {
                return (new UnauthorizedResponse(['error' => 'Unauthorized: Missing authorization token.']))->response();
            } else {
                return (new UnauthorizedResponse(['error' => 'Unauthorized. Error.']))->response();
            }
        }
        if (! $user) {
            return (new UnauthorizedResponse(['error' => 'Unauthorized: User not found.']))->response();
        }

        return $next($request);
    }
}
