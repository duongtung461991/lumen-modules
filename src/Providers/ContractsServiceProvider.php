<?php

namespace dxmb\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use dxmb\Modules\Contracts\RepositoryInterface;
use dxmb\Modules\Laravel\LaravelFileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, LaravelFileRepository::class);
    }
}
