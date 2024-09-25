<?php

namespace App\Services\Disasters;

use App\Interfaces\DisastersRepositoryInterface;
use Illuminate\Support\Facades\Http;

class CreateDisastersService
{
    private $disastersRepository;
    private $baseUrl;
    private $authentication;
    public function __construct(DisastersRepositoryInterface $disastersRepository){

            $this->baseUrl = env('API_DISASTER');
            $this->disastersRepository = $disastersRepository;
            $this->authentication = env('TOKEN_API_DISASTER');
        }

        public function index(){

            $disasters = Http::withHeaders(['auth-token' => $this->authentication])
                             ->get("{$this->baseUrl}/rest/portal/reconhecimentos");

            $listDisasters = json_decode($disasters->body());

            $this->disastersRepository->deleteAll();

            foreach($listDisasters->features as $disaster)
            {
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
