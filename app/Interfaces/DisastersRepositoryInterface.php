<?php

namespace App\Interfaces;

use App\Models\Disasters;
use Illuminate\Database\Eloquent\Model;

interface DisastersRepositoryInterface
{

    public function create(array $data);
    public function deleteAll();
    public function getAllWithCobrade();

}
