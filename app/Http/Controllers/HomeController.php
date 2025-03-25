<?php

namespace App\Http\Controllers;

use App\Events\ChatGroup;
use App\Models\Group;
use App\Models\GroupDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '<>', Auth::id())->get();
        $myGroup = Group::where('leader_id', Auth::id())->get();
        $myGroupNotLeader = Group::leftJoin('group_details', 'groups.id', '=', 'group_details.group_id')
            ->select('groups.id', 'groups.name')
            ->where('group_details.member_id', Auth::id())->get();
        return view('home', compact('users', 'myGroup', 'myGroupNotLeader'));
    }
    public function createGroup(Request $request)
    {
        if (count($request->member_id) >= 3) {
            $group = Group::query()->create([
                'name' => $request->name,
                'leader_id' => Auth::id(),
            ]);
            foreach ($request->member_id as $member_id) {
                GroupDetail::query()->create([
                    'group_id' => $group->id,
                    'member_id' => $member_id,
                ]);
            }
        }
        return back();
    }
    public function chatGroup($groupId)
    {
        $group = Group::findOrFail($groupId);
        $leader = User::findOrFail($group->leader_id);
        $member_id = GroupDetail::where('group_id', $group->id)->pluck('member_id')->toArray();
        $members = User::whereIn('id', $member_id)->get();
        return view('chat.chat-group', compact('leader', 'group', 'members'));
    }

    public function postMessageGroup(Request $request)
    {
        $group = Group::findOrFail($request->groupId);
        broadcast(new ChatGroup($group, $request->user(), $request->message));
        return response()->json('successfully');
    }
}
