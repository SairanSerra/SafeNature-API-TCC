<?php

namespace App\Services\Disasters;

use App\Interfaces\DisastersRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;

class CreateDisastersService
{
    private $disastersRepository;
    private $baseUrl;
    public function __construct(DisastersRepositoryInterface $disastersRepository)
    {

        $this->baseUrl = env('API_DISASTER');
        $this->disastersRepository = $disastersRepository;
    }

    public function index()
    {

        $scriptPath = base_path('resources/js/playwright-script.js');

        $process = new Process(['node', $scriptPath]);

        $process->run();

        $output = trim($process->getOutput());

        $authToken = $output;

        $disasters = Http::withHeaders(['auth-token' => $authToken])
            ->get("{$this->baseUrl}/rest/portal/reconhecimentos");

        $listDisasters = json_decode($disasters->body());

        $this->disastersRepository->deleteAll();

        foreach ($listDisasters->features as $disaster) {
            $this->disastersRepository->create([
                'longitude'     => $disaster->geometry->coordinates[0],
                'latitude'      => $disaster->geometry->coordinates[1],
                'idCobrade'     => $disaster->properties->cobrade,
                'city'          => $disaster->properties->municipio,
                'state'         => $disaster->properties->uf
            ]);
        }
    }
}
