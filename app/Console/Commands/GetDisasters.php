<?php

namespace App\Console\Commands;

use App\Services\Disasters\CreateCobradeService;
use App\Services\Disasters\CreateDisastersService;
use Illuminate\Console\Command;

class GetDisasters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getDisasters:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pegar lista de desastres naturais';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $createCobradeService;
    private $createDisastersService;
    public function __construct(CreateCobradeService $createCobradeService,
                                CreateDisastersService $createDisastersService)
    {
        parent::__construct();
        $this->createCobradeService = $createCobradeService;
        $this->createDisastersService = $createDisastersService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createCobradeService->index();
        $this->createDisastersService->index();
    }
}
