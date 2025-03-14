<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    const VIEW_TEMPLATE = 'users.';
    const UPLOAD = 'uploads/users';
    protected $userService;
    protected $userRepository;

    public function __construct(UserService $userService, UserRepositoryInterface $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->all(['id', 'name', 'email', 'avatar'],['posts']);
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_TEMPLATE . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
       $data = $request->except('avatar');
       $password = $data['password'];
       if($request->has('avatar')){
           $data['avatar'] = Storage::put(self::UPLOAD, $request->file('avatar'));
       }
       $user = $this->userRepository->create($data);
       $this->userService->sendMailToUser($user, $password);
       return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->findById($id, ['name', 'email'], ['posts']);
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->findById($id);
        return view(self::VIEW_TEMPLATE . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->all();
        $this->userRepository->update($id, $data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userRepository->delete($id);
        return back();
    }
}
