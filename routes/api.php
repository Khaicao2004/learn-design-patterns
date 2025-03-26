<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
Route::get('group-chat/{groupId}/messages', [ChatController::class, 'getGroupMessages'])->name('group.getGroupMessages');
// Route::get('private-chat/{receiverId}/messages', [ChatController::class, 'getPrivateMessages'])->name('private.getPrivateMessages');