<?php

namespace App\Http\Controllers;

use App\Events\ChatPrivate;
use App\Events\UserOnline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::query()->where('id', '<>', Auth::id())->latest('id')->get();
        return view('chat.chat-public', compact('users'));
    }
    public function postMessage(Request $request)
    {
        broadcast(new UserOnline($request->user(), $request->message));
        // event(new UserOnline($request->user(), $request->message));
        return response()->json('successfully');
    }
    public function chatPrivate($userId)
    {
        $user = User::findOrFail($userId); // id nguoi nhan
        return view('chat.chat-private', compact('user'));
    }
    public function postMessagePrivate($userId, Request $request)
    {
        $user = User::findOrFail($userId); // id nguoi nhan
        broadcast(new ChatPrivate($request->user(), $user, $request->message));
        return response()->json('successfully');
    }
}
