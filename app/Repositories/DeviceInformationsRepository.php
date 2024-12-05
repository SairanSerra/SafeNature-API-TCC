<?php

namespace App\Repositories;

use App\Interfaces\DeviceInformationsRepositoryInterface;
use App\Models\DeviceInformations;

class DeviceInformationsRepository implements DeviceInformationsRepositoryInterface
{
    private $model;
    public function __construct(DeviceInformations $deviceInformations)
    {
        $this->model = $deviceInformations;
    }

    public function createOrUpdate(array $data)
    {
        $deviceInformation = $this->model->upsert($data, 'deviceId', ['latitude', 'longitude']);
        return $deviceInformation;
    }

}
