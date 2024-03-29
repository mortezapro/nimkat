<?php
namespace App\Services\Telegram;

use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Message implements TelegramInterface {

    protected mixed $update;
    protected UserServiceInterface $userService;
    public function __construct($update,UserServiceInterface $userService)
    {
        $this->update = $update;
        $this->userService = $userService;
    }

    public function handle()
    {
        Log::info($this->update->message->from);
        if(!$this->userService->exist( $this->update->message->from->id )){
            $this->userService->store( (array)$this->update->message->from );
        }
    }
}
