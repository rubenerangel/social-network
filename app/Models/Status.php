<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use App\Traits\HasLikesTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    use HasLikesTraits;

    /**
     * Deshabilitamos la protección contra asignación masiva siempre que no hagamos cosas del tipo Status::create(request->all())
     * */ 
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }
}
