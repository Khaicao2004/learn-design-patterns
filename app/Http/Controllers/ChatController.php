<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::query()->latest('id')->get();
        return view('chat.chat-public', compact('users'));
    }
    public function postMessage(Request $request)
    {
       return json_encode([
        'data' => $request->message
       ]);
    }
}
