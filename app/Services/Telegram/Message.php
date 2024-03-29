<?php
namespace App\Services\Telegram;

use Illuminate\Support\Facades\Log;

class Message implements TelegramInterface {

    protected $update;
    public function __construct($update)
    {
        $this->update = $update;
    }

    public function handle()
    {
        Log::info($this->update);
    }
}
