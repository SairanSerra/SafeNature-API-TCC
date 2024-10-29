<?php

namespace App\Repositories;

use App\Interfaces\DisastersRepositoryInterface;
use App\Models\Disasters;
use Illuminate\Database\Eloquent\Model;

class DisastersRepository implements DisastersRepositoryInterface
{
    private $model;
    public function __construct(Disasters $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function deleteAll()
    {
        return $this->model->query()->delete();
    }

    public function getAllWithCobrade()
    {
        return $this->model->with('cobrade')->get();
    }

}
