<?php
namespace App\Services\Telegram;

use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Message implements TelegramInterface {

    protected mixed $update;
    protected UserService $userService;
    public function __construct($update)
    {
        $this->update = $update;
        $this->userService = App::make(UserService::class);
    }

    public function handle()
    {
//        $array = (array) $this->update;
        $update = (array)$this->update;
        $keys = array_keys($update);
        Log::info((object)$keys);
//        if(!$this->userService->exist( $this->update->message->id )){
//            $this->userService->store( (array)$this->update->message );
//        }
    }
}
