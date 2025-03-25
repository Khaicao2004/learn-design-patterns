<?php

use App\Models\Group;
use App\Models\GroupDetail;
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

Broadcast::channel('vouchers', function () {
    return true;
});

Broadcast::channel('chat', function ($user) {
    if($user != null){
        return ['id' => $user->id, 'name' => $user->name];
    } 
    return false;
});

Broadcast::channel('chat-private.{userSendId}.{userReceiverId}', function ($user, $userSendId, $userReceiverId) {
    if($user != null){
        if($user->id == $userSendId || $user->id == $userReceiverId){
            return true;
        }
    }
    return false;
});

Broadcast::channel('chat-group.{groupId}', function ($user, $groupId) {
    if($user != null){
       $group = Group::findOrFail($groupId);
       $memberId = GroupDetail::where('group_id', $groupId)->pluck('member_id')->toArray();
       if($user->id == $group->leader_id || in_array($user->id, $memberId)){
            return true;        
       }
    }
    return false;
});