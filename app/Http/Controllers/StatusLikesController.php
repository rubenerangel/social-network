<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusLikesController extends Controller
{
    /** @test */
    public function store(Status $status)
    {
        $status->like();

        // $status->likes()->create([
        //     'user_id' => auth()->id()
        // ]);
    }
}
