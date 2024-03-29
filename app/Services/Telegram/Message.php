<?php
namespace App\Services\Telegram;

use Illuminate\Support\Facades\Log;

class Message implements TelegramInterface {

    protected $update;
    protected $action;
    public function __construct($update,array $action)
    {
        $this->update = $update;
        $this->action = $action;
    }

    public function handle()
    {
        Log::info($this->update);
    }
}
