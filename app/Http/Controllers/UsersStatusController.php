<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\StatusResource;

class UsersStatusController extends Controller
{
    public function index(User $user)
    {
        return StatusResource::collection(
            $user->statuses()->latest()->paginate()
        );
    }
}
