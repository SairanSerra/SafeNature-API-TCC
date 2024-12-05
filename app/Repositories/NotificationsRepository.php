<?php

namespace App\Repositories;

use App\Models\Notifications;

class NotificationsRepository
{
    private $model;

    public function __construct(Notifications $notifications)
    {
        $this->model = $notifications;
    }

    public function create(int $idOccurence, string $deviceId)
    {
        $notification = $this->model->create([
            'idOcurrence'   => $idOccurence,
            'deviceId'      => $deviceId
        ]);

        return $notification;
    }

    public function findLastNotification(int $idOccurence, string $deviceId)
    {
        $notification = $this->model->where('idOcurrence', $idOccurence)
                                    ->where('deviceId', $deviceId)
                                    ->orderByDesc('createdAt')
                                    ->first();

        return $notification;
    }

}
