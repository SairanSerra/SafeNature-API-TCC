<?php

namespace App\Providers;

use App\Interfaces\CobradeRepositoryInterface;
use App\Interfaces\DisastersRepositoryInterface;
use App\Repositories\CobradeRepository;
use App\Repositories\DisastersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DisastersRepositoryInterface::class, DisastersRepository::class);
        $this->app->bind(CobradeRepositoryInterface::class, CobradeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
