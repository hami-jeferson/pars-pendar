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
        return [
            'slug'=> $this->slug,
            'title'=> $this->title,
            'content'=> $this->content,
            'image'=> !empty($this->image) ? $this->image->url : null,
            'comment_cnt'=> $this->comment()->count(),
            'like'=> $this->feedback()->Action('like')->count(),
            'dislike'=> $this->feedback()->Action('dislike')->count(),
        ];
    }
}
