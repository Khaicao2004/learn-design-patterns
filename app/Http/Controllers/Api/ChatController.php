<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatPrivate;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getGroupMessages($groupId)
    {
        $group = Group::findOrFail($groupId);
        $messages = Message::where('group_id', $group->id)->with('sender')->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }
    public function getPrivateMessages($receiverId)
    {
        $userSendId = Auth::id();
        $messages = ChatPrivate::where(function ($query) use ($userSendId, $receiverId) {
            $query->where('sender_id', $userSendId)
                  ->where('receiver_id', $receiverId);
        })
        ->orWhere(function ($query) use ($userSendId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $userSendId);
        })
        ->orderByDesc('created_at')
        ->get();
        return response()->json($messages);
    }
}
