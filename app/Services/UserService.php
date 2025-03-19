<?php

namespace App\Services;

use App\Jobs\SendMailToUser;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function sendMailToUser($user, $password)
    {
        SendMailToUser::dispatch($user, $password);
    }
   
    public function paginate()
    {
        return $this->userRepository->getAllPaginate();
    }
}
