<?php

namespace App\Services\Interfaces;

interface UserServiceInterface{
    public function sendMailToUser($user, $password);
    public function paginate();
}