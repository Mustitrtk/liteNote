<?php

namespace App\Providers;

use App\Service\Abstract\CrudRepository;
use App\Service\Concrete\NoteCrudRepository;
use Illuminate\Support\ServiceProvider;

class NoteProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CrudRepository::class,NoteCrudRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
