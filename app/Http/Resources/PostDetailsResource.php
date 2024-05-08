<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hasComment = false;
        $myFeedback = null;
        $userId = auth()->id();
        if(!empty($userId)){
            if($this->comment()->UserId(auth()->id())->count() > 0)  $hasComment = true;
            $action = $this->feedback()->UserId(auth()->id())->first();
            if(!empty($action)) $myFeedback = $action->action;
        }
        return [
            'slug'=> $this->slug,
            'title'=> $this->title,
            'content'=> $this->content,
            'image'=> !empty($this->image) ? $this->image->url : null,
            'feedback'=> [
                'comment_cnt'=> $this->comment()->count(),
                'like'=> $this->feedback()->Action('like')->count(),
                'dislike'=> $this->feedback()->Action('dislike')->count(),
            ],
            'my_feedback'=> [
                'has_comment'=> $hasComment,
                'action'=> $myFeedback
            ]
        ];
    }
}
