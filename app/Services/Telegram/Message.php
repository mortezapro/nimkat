<?php
namespace App\Services\Telegram;

use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update as UpdateObject;

class Message implements TelegramInterface {

    protected UpdateObject $update;
    protected UserService $userService;
    public function __construct(UpdateObject $update)
    {
        $this->update = $update;
        $this->userService = App::make(UserService::class);
    }

    public function handle()
    {
//        $array = (array) $this->update;

        $text = $this->update->message->text;
        $messageId = $this->update->message->messageId;
        $chatId = $this->update->getChat()->get("id");

        $userData = [
            "id" => $this->update->message->from->id,
            "first_name" => $this->update->message->from->firstName,
            "last_name" => $this->update->message->from->lastName,
            "username" => $this->update->message->from->username,
            "role" => 2020
        ];

        if(!$this->userService->exist( $this->update->message->from->id )){
//            $user = $this->userService->store($userData);
            Log::info("no exist");
        } else {
            Log::info("exist");
        }

    }
}
