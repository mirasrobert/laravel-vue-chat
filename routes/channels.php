<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Authorize Private Channel
// Broadcast::channel('chat', function () {
//     return true;
// });

Broadcast::channel('chat.room.{id}', function ($user, $id) {
    // Authorize users based on the chat room.
    // For example, you could check if the user is a participant of the chat room.

    $chatRoom = ChatRoom::find($id);
    return $chatRoom->participants->contains('user_id', $user->id); // Check if user is participant of that chatroom
});
