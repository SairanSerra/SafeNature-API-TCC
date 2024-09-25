<?php

namespace App\Repositories;

use App\Interfaces\CobradeRepositoryInterface;
use App\Models\Cobrade;

class CobradeRepository implements CobradeRepositoryInterface
{

    private $model;
    public function __construct(Cobrade $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->upsert($data, 'cobrade', ['description', 'type']);
    }

}
