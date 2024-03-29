<?php

namespace App\Providers;

use App\Services\Message\MessageService;
use App\Services\Message\MessageServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UserServiceInterface::class => UserService::class,
        MessageServiceInterface::class => MessageService::class,
    ];
}
