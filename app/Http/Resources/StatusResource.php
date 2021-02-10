<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'body' => $this->resource->body,
            'user' => UserResource::make($this->user),
            /* 'user_name' => $this->resource->user->name, //se chequean las relaciones en la DB
            'user_link' => $this->user->link(),
            'user_avatar' => $this->user->avatar(), */
            // 'ago' => $this->resource->created_at->diffForHumans(),
            'created_at' => $this->resource->created_at,
            'is_liked' => $this->isLiked(),
            'likes_count' => $this->likesCount(),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
