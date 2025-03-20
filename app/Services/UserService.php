<?php

namespace App\Services;

use App\Mail\CreateUserEmail;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Mail;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function sendMailToUser($user, $password)
    {
        Mail::to($user->email)->send(new CreateUserEmail($user, $password));
    }
   
    public function paginate()
    {
        return $this->userRepository->getAllPaginate();
    }
}
