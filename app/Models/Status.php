<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
