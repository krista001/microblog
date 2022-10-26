<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PostResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $posts = [];

        foreach($this->posts as $post)
        {
            if(!$post->is_private)
            {
                $comments = [];

                foreach($post->comments as $comment)
                {
                    $comments[] = [
                        'author' => $comment->user->name,
                        'comment' => $comment->comment,
                    ];
                }
    
                $posts[] = [
                    'id' => $post->id,
                    'post' => $post->text,
                    'created_at' => $post->created_at,
                    'author' => $post->user->name,
                    'comments' => $comments,
                ];
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'posts' => $posts,
        ];
    }
}
