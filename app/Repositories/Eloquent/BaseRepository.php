<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all(array $columns = ['*'], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->get();
    }
    public function findById(int $id, array $columns = ['*'], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->findById($id)->update($data);
    }
    public function delete(int $id)
    {
        return $this->findById($id)->delete();
    }
}
