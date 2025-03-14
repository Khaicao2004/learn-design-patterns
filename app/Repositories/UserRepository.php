<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    // get all users
    public function getAllUsers()
    {
        return User::all();
    }

    //find user with id
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    // create new user
    public function createUser($data)
    {
        return User::query()->create($data);
    }

    // update user with id
    public function updateUser($id, $data)
    {
        $user = $this->findById($id);
        return $user->update($data);
    }

    // delete user with id
    public function deleteUser($id)
    {
        $user = $this->findById($id);
        return $user->delete();
    }
}
