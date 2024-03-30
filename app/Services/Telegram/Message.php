<?php
namespace App\Services\Telegram;

use App\Services\Message\MessageService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update as UpdateObject;

class Message implements TelegramInterface {

    protected UpdateObject $update;
    protected UserService $userService;
    protected MessageService $messageService;
    public function __construct(UpdateObject $update)
    {
        $this->update = $update;
        $this->userService = App::make(UserService::class);
    }

    public function handle()
    {
        $userData = [
            "id" => $this->update->message->from->id,
            "first_name" => $this->update->message->from->firstName,
            "last_name" => $this->update->message->from->lastName,
            "username" => $this->update->message->from->username,
            "role" => 2020
        ];
        $messageData = [
            "id"        => $this->update->message->from->id,
            "user_id"   => $this->update->message->messageId,
            "chat_id"   => $this->update->getChat()->get("id"),
            "text"      => $this->update->message->text,
        ];
        Log::info($this->userService->count( ["id" => $this->update->message->from->id]) == 0));
        if($this->userService->count( ["id" => $this->update->message->from->id]) == 0){
            $this->userService->store($userData);
        }

        $this->messageService->store($messageData);

    }
}
