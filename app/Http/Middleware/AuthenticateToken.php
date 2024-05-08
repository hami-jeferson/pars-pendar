<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authorization token exists in the request
        if ($request->header('Authorization')) {
            // Extract the token from the request headers
            $token = $request->header('Authorization');
            $token = trim(str_replace(['Bearer', 'bearer'], ['',''], $token));
            $personalAccessToken = PersonalAccessToken::findToken($token);
            if(!empty($personalAccessToken)){
                $user = $personalAccessToken->tokenable;
                auth()->login($user);
            }
            return $next($request);
        }
        return $next($request);
    }
}
