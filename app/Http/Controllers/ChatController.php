<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('chat-realtime', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
    }
}
