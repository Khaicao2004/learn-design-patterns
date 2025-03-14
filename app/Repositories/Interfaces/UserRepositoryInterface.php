<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface{
    public function getAllUsers();
    public function findById($id);
    public function createUser($data);
    public function updateUser($id, $data);
    public function deleteUser($id);
}