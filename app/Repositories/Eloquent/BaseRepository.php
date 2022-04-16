<?php

namespace App\Repositories\Eloquent;



use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
    
    
    public function create(array $attributes) : Model
    {
        return $this->model->create($attributes);
    }


    public function update(array $attributes,$id)
    {
        return $this->model->find($id)->update($attributes);
    }


    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }


}