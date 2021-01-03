<?php

namespace App\Http\Resources;

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
            'user_name' => $this->resource->user->name, //se chequean las relaciones en la DB
            'user_avatar' => 'https://aprendible.com/images/default-avatar.jpg',
            // 'ago' => $this->resource->created_at->diffForHumans(),
            'created_at' => $this->resource->created_at,
            'is_liked' => $this->isLiked(),
            'likes_count' => $this->likesCount(),
        ];
    }
}
