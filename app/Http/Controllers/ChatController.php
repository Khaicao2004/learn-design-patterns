<?php

namespace App\Http\Controllers;

use App\Events\ChatPrivate;
use App\Events\UserOnline;
use App\Models\ChatPrivate as ModelsChatPrivate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $allUsers = User::query()->where('id', '<>', Auth::id())->latest('id')->get();
        $lastMessage = ModelsChatPrivate::where('sender_id', Auth::id())
        ->orWhere('receiver_id', Auth::id())
        ->latest()
        ->first();
        if($lastMessage){
            $lastChatUserId = ($lastMessage->sender_id == Auth::id()) ? $lastMessage->receiver_id : $lastMessage->sender_id;
            $userReceiver = User::findOrFail($lastChatUserId);
        }else{
            $userReceiver = User::first();
        }
        return view('chat.chat-application', compact('allUsers', 'userReceiver'));
    }
    public function postMessage(Request $request)
    {
        broadcast(new UserOnline($request->user(), $request->message));
        return response()->json('successfully');
    }
    public function chatPrivate($userId)
    {
        $allUsers = User::query()->where('id', '<>', Auth::id())->latest('id')->get();
        $userReceiver = User::findOrFail($userId); // id nguoi nhan
        return view('chat.chat-application', compact('allUsers', 'userReceiver'));
    }
    public function postMessagePrivate($userId, Request $request)
    {
        $sendUser = $request->user();
        $userReceiver = User::findOrFail($userId); // id nguoi nhan
        $messages = ModelsChatPrivate::query()->create([
            'sender_id' =>  $sendUser->id,
            'receiver_id' =>  $userReceiver->id,
            'content' => $request->message
        ]);
        broadcast(new ChatPrivate($sendUser,$userReceiver,  $messages->content));
        return response()->json('successfully');
    }
    public function getPrivateMessages(Request $request, $receiverId)
    {
        $userSendId =$request->user()->id;
        $messages = ModelsChatPrivate::with('sender')->where(function ($query) use ($userSendId, $receiverId) {
            $query->where('sender_id', $userSendId)
                  ->where('receiver_id', $receiverId);
        })
        ->orWhere(function ($query) use ($userSendId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $userSendId);
        })
        ->orderBy('created_at', 'asc')
        ->get();
        return response()->json($messages);
    }
}
