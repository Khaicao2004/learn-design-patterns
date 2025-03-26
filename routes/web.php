<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('public', function(){
    return view('public');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth_check')->group(function() {
    //chat public
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('post-message', [ChatController::class, 'postMessage'])->name('chat.postMessage');
    
    //chat private
    Route::get('chat-private/{userId}', [ChatController::class, 'chatPrivate'])->name('chat.chatPrivate');
    Route::post('post-message-private{userId}', [ChatController::class, 'postMessagePrivate'])->name('chat.postMessagePrivate');
    Route::post('group/create', [HomeController::class, 'createGroup'])->name('group.createGroup');
    Route::get('group-chat/{groupId}', [HomeController::class, 'chatGroup'])->name('group.chatGroup');
    Route::post('post-message-group', [HomeController::class, 'postMessageGroup'])->name('chat.postMessageGroup');
    Route::get('private-chat/{receiverId}/messages', [ChatController::class, 'getPrivateMessages'])->name('private.getPrivateMessages');
});
