<?php
namespace App\Services\Telegram;

use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Message implements TelegramInterface {

    protected mixed $update;
    protected UserServiceInterface $userService;
    public function __construct($update)
    {
        $this->update = $update;
//        $this->userService = App::make(UserServiceInterface::class);
    }

    public function handle()
    {
        Log::info($this->update->message);
        if(!$this->userService->exist( $this->update->message->id )){
            $this->userService->store( (array)$this->update->message );
        }
    }
}
