<?php

namespace App\Traits;

use App\Models\Like;

trait HasLikesTraits
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }
    
    public function unlike()
    {
        $this->likes()->where([
            'user_id' => auth()->id()
        ])->delete();
    }

    public function isLiked()
    {
        // return false;
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }
}
