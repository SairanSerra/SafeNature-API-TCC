<?php

namespace App\Services\Disasters;

use App\Interfaces\DisastersRepositoryInterface;

class ListDisastersService
{
    private $disastersRepository;
    public function __construct(DisastersRepositoryInterface $disastersRepository)
    {
        $this->disastersRepository = $disastersRepository;
    }

    public function index(): void
    {
        $listDisasters = $this->disastersRepository->getAllWithCobrade();


    }

}
