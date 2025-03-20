<?php

namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface{
    public function all(array $columns = ['*'], array $relation = []);
    public function findById(int $id, array $columns = ['*'], array $relation = []);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}