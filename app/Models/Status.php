<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    /**
     * Deshabilitamos la protección contra asignación masiva siempre que no hagamos cosas del tipo Status::create(request->all())
     * */ 
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function isLiked()
    {
        // return false;
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function unlike()
    {
        $this->likes()->where([
            'user_id' => auth()->id()
        ])->delete();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }
}
