<?php

use App\Http\Controllers\ChatController;
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

Route::get('/', function(){
    return 111;
});

Route::get('public', function(){
    return view('public');
});

//Message
Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('chat/{id}', [ChatController::class, 'show'])->name('chat.show');