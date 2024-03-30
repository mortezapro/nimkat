<?php
namespace App\Services\Telegram;

use Illuminate\Support\Facades\Log;

class TelegramService{
    protected $update;
    protected $action;
    public function __construct($update,string $action)
    {
        $this->update = $update;
        $this->action = $action;
    }

    public function handle()
    {
        $normalizedName = ucfirst($this->action);
        $namespace = 'App\Services\Telegram';
        $class = $namespace . "\\$normalizedName";
        Log::info($class);
        (new $class($this->update))->handle();

    }
}
