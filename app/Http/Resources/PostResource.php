<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $comments = [];

        foreach($this->comments as $comment)
        {
            $comments[] = [
                'author' => $comment->user->name,
                'comment' => $comment->comment,
            ];
        }

        return [
            'post' => $this->text,
            'created_at' => $this->created_at,
            'author' => $this->user->name,
            'comments' => $comments,
        ];
    }
}
