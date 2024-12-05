<?php

namespace App\Services\Disasters;

use App\Interfaces\DeviceInformationsRepositoryInterface;
use App\Interfaces\DisastersRepositoryInterface;
use App\Services\DefaultResponse\DefaultResponse;
use App\Services\Notification\SendPushService;
use App\Utils\CalculateDistanceByLatLong;

class CheckDisasterService
{
    private $defaultResponse;
    private $calculateDistanceByLatLong;
    private $disastersRepository;
    private $sendPushService;
    private $deviceInformationsRepository;
    public function __construct(DefaultResponse $defaultResponse,
                                CalculateDistanceByLatLong $calculateDistanceByLatLong,
                                DisastersRepositoryInterface $disastersRepository,
                                SendPushService $sendPushService,
                                DeviceInformationsRepositoryInterface $deviceInformationsRepository)
    {
        $this->defaultResponse = $defaultResponse;
        $this->calculateDistanceByLatLong = $calculateDistanceByLatLong;
        $this->disastersRepository = $disastersRepository;
        $this->sendPushService = $sendPushService;
        $this->deviceInformationsRepository = $deviceInformationsRepository;
    }

    public function index(array $payload)
    {
        $latitude = $payload['latitude'];
        $longitude = $payload['longitude'];
        $deviceId = $payload['deviceId'];

        $this->deviceInformationsRepository->createOrUpdate($payload);

        $listDisasters = $this->disastersRepository->getAllWithCobrade();

        foreach($listDisasters as $disaster){
            $latitudeDisaster = $disaster->latitude;
            $longitudeDisaster = $disaster->longitude;
            $distance = $this->calculateDistanceByLatLong->index($latitudeDisaster, $longitudeDisaster, $latitude, $longitude);

            if($distance <= 100){
                $this->sendPushService->index('Alerta', $disaster->cobrade->type, $deviceId);
            }
        }

        return $this->defaultResponse->isSuccess('Sucesso ao validar localização', 200);

    }

}
