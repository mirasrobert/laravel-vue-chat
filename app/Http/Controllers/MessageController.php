<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chatRoomId = 1)
    {
        $messages = Message::where('chat_room_id', $chatRoomId)
                            ->with('user')
                            ->get();

        return response()->json($messages);
    }
}
