<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckDisasterRequest;
use App\Http\Requests\ListRequest;
use App\Services\Disasters\CheckDisasterService;
use App\Services\Disasters\ListDisastersService;
use Illuminate\Http\Request;

class DisastersController extends Controller
{
    private $listDisastersService;
    private $checkDisasterService;
    public function __construct(ListDisastersService $listDisastersService,
                                CheckDisasterService $checkDisasterService)
    {
        $this->listDisastersService = $listDisastersService;
        $this->checkDisasterService = $checkDisasterService;
    }

    public function list(ListRequest $request)
    {
        $payload = $request->validated();
        return $this->listDisastersService->index($payload);
    }

    public function checkDisaster(CheckDisasterRequest $request)
    {
        $payload = $request->validated();
        return $this->checkDisasterService->index($payload);
    }
}
