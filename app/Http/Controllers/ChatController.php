<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    // Hit this route via ajax
    public function send(Request $request)
    {
        $user = User::find(auth()->id());
        $message = $request->input('message');

        event(new ChatEvent($message, $user));

        // $user = User::find(auth()->id());
        // $message = $request->input('message');
        // $chatRoomId = $request->input('chat_room_id'); // Coming from vue js

        // event(new ChatEvent($message, $user, $chatRoomId));

    }
}
