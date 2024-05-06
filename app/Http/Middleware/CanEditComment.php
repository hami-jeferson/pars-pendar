<?php

namespace App\Http\Middleware;

use App\Models\CommentModel;
use App\Repositories\CommentRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\Response as TraitResponse;
class CanEditComment
{
    use TraitResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$commentRepository = new CommentRepository();
        //$comment = $commentRepository->getById($request->route('comment'));
        $comment = $request->route('comment');
        if ($comment->user_id !== auth()->id()) {
            return $this->error(msg: 'You are not owner of comment');
        }

        return $next($request);
    }
}
