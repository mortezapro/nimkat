<?php
namespace App\Services\Telegram;

use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
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
        $this->userService->firstOrCreate($userData);
        $this->userService->store($messageData);

//        Log::info($this->userService->count( ["id" => $this->update->message->from->id]));
//        if(!$this->userService->count( ["id","=",$this->update->message->from->id]) == 0){
//            $user = $this->userService->store($userData);
//            Log::info("no exist");
//        } else {
//            Log::info("exist");
//        }

    }
}
