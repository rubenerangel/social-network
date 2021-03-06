<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    public function index()
    {
        return StatusResource::collection(
            Status::latest()->paginate()
        );
    }

    public function store(Request $request)
    {
        request()->validate(['body' => 'required|min:5']);

        $status = Status::create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        // return response()->json(['body' => $status->body]);
        return StatusResource::make($status);
    }
} 
