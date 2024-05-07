<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\Response as TraitResponse;
class CanCRUDPost
{
    use TraitResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('post');
        if(auth()->user()->type == 'admin' or (empty($post) && auth()->user()->type == 'author') or (!empty($post) && $post->user_id = auth()->id())){
            // every thing fine
        }else{
            return $this->error(msg: 'You have not access');
        }
        return $next($request);
    }
}
