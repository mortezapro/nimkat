<?php

namespace App\Providers;

use App\Services\Message\MessageService;
use App\Services\Message\MessageServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class,
        );
        $this->app->bind(
            MessageServiceInterface::class,
            MessageService::class,
        );
    }
}
