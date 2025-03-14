<?php

namespace App\Services;

use App\Mail\CreateUserEmail;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser($data, $password)
    {
        $user = $this->userRepository->createUser($data);
        Mail::to($user->email)->send(new CreateUserEmail($user, $password));
    }

    public function updateUser($id, $data)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
