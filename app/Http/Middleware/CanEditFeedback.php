<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEditFeedback
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $feedback = $request->route('feedback');
        if ($feedback->user_id !== auth()->id()) {
            return $this->error(msg: 'You are not owner of feedback');
        }
        return $next($request);
    }
}
