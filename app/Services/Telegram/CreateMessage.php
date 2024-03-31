<?php
namespace App\Services\Telegram;

use App\Models\MessageModel;
use App\Services\Message\MessageService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update as UpdateObject;

class CreateMessage implements TelegramInterface {

    protected UpdateObject $update;
    protected UserService $userService;
    protected MessageService $messageService;
    public function __construct(UpdateObject $update)
    {
        $this->update = $update;
        $this->userService = App::make(UserService::class);
        $this->messageService = App::make(messageService::class);
    }

    public function handle()
    {
        Log::info("creating message");
        Log::info($this->update);
        $userData = [
            "id" => $this->update->message->from->id,
            "first_name" => $this->update->message->from->firstName,
            "last_name" => $this->update->message->from->lastName,
            "username" => $this->update->message->from->username,
            "role" => 2020
        ];
        $messageData = [
            "id"        => $this->update->message->messageId,
            "user_id"   => $this->update->message->from->id,
            "chat_id"   => (string)$this->update->getChat()->get("id"),
            "text"      => (string)$this->update->message->text,
        ];
        if($this->userService->count( ["id" => $this->update->message->from->id]) == 0){
            $this->userService->store($userData);
            Log::info("create message");
        }
        $this->messageService->store($messageData);
        Log::info("message created");
    }
}
