<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Http\Request;

class RequestFriendshipsController extends Controller
{
    public function store(User $sender)
    {
        Friendship::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id(),
            'accepted' => false
        ])->update(['accepted' => true]);
    }
}
