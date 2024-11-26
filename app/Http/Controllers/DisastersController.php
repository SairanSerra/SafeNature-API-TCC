<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Services\Disasters\ListDisastersService;
use Illuminate\Http\Request;

class DisastersController extends Controller
{
    private $listDisastersService;
    public function __construct(ListDisastersService $listDisastersService)
    {
        $this->listDisastersService = $listDisastersService;
    }

    public function list(ListRequest $request)
    {
        $payload = $request->validated();
        return $this->listDisastersService->index($payload);
    }
}
