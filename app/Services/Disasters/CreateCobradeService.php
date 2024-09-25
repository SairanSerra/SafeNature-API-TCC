<?php

namespace App\Services\Disasters;

use App\Interfaces\CobradeRepositoryInterface;
use Illuminate\Support\Facades\Http;

class CreateCobradeService
{
    private $baseUrl;
    private $cobradeRepository;

    public function __construct(CobradeRepositoryInterface $cobradeRepository)
    {
        $this->baseUrl = env('API_DISASTER');
        $this->cobradeRepository = $cobradeRepository;
    }

    public function index(){

        $cobrades = Http::get("{$this->baseUrl}/rest/cobrades");
        $listCobrades = json_decode($cobrades->body());

        foreach($listCobrades as $cobrade)
        {
            $this->cobradeRepository->create([
                'cobrade'       => $cobrade->cobrade,
                'type'          => $cobrade->tipo,
                'description'   => $cobrade->descricao,
            ]);
        }
    }

}
