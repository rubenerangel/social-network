<?php

namespace App\Models;

use App\Models\User;
use App\Traits\HasLikesTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;

    use HasLikesTraits;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
