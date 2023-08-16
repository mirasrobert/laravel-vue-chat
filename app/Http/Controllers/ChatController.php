<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\ChatEvent;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function index($id = 1)
    {
        $chatRoom = ChatRoom::find($id);

        abort_if(!$chatRoom, 404); // Chat Room Not Found

        return view('chat');
    }

    // Save Message
    public function saveMessage($user, $chatRoomId, $message)
    {
        $user = User::find(auth()->id());

        // Save Message to Database
        Message::create([
            'user_id' => $user->id,
            'chat_room_id' => $chatRoomId,
            'content' => $message
        ]);
    }

    // Hit this route via ajax
    public function send(Request $request)
    {

        $request->validate([
            'chat_room_id' => 'required',
            'message' => 'required|string'
        ]);

        $user = User::find(auth()->id());
        $message = $request->input('message');
        $chatRoomId = $request->input('chat_room_id'); // Coming from vue js

        $this->saveMessage($user, $chatRoomId, $message);

        event(new ChatEvent($message, $user, $chatRoomId));
    }

}
