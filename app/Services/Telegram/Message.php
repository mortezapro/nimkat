<?php
namespace App\Services\Telegram;

use App\Models\MessageModel;
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
        $this->messageService = App::make(messageService::class);
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
//        $messageData = [
//            "id"        => $this->update->message->from->id,
//            "user_id"   => $this->update->message->messageId,
//            "chat_id"   => $this->update->getChat()->get("id"),
//            "text"      => $this->update->message->text,
//        ];
        if($this->userService->count( ["id" => $this->update->message->from->id]) == 0){
            $this->userService->store($userData);
        }
        $message = new MessageModel();
        $message->id = $this->update->message->from->id;
        $message->user_id = $this->update->message->messageId;
        $message->chat_id = (string)$this->update->getChat()->get("id");
        $message->text = (string)$this->update->message->text;
        $message->save();
//        $this->messageService->store($messageData);

    }
}
