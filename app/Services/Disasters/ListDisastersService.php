<?php

namespace App\Services\Disasters;

use App\Http\Resources\ListDisasterWithCobradeResource;
use App\Interfaces\DisastersRepositoryInterface;
use App\Services\DefaultResponse\DefaultResponse;

class ListDisastersService
{
    private $disastersRepository;
    private $defaultResponse;
    public function __construct(DisastersRepositoryInterface $disastersRepository,
                                DefaultResponse $defaultResponse)
    {
        $this->disastersRepository = $disastersRepository;
        $this->defaultResponse = $defaultResponse;
    }

    public function index(array $payload)
    {
        $listDisasters = $this->disastersRepository->getAllWithCobrade();

        $latitude = $payload['latitude'] ?? false;
        $longitude = $payload['longitude'] ?? false;

        $hasExistLatLong = $latitude && $longitude;

        $content = collect(ListDisasterWithCobradeResource::collection($listDisasters));

        $content = $content->sortBy($hasExistLatLong ? 'distance' : 'id');

        return $this->defaultResponse->isSuccessWithContent('Lista de ocorrências', 200, $content);
    }

}
