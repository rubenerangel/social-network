<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class StatusCommentController extends Controller
{
    public function store(Status $status)
    {
        request()->validate([
            'body' => 'required'
        ]);

        $comment = Comment::create([
            'user_id'   => auth()->id(),
            'status_id' => $status->id,
            'body'      => request('body'),
        ]);

        return CommentResource::make($comment);
    }
}  
