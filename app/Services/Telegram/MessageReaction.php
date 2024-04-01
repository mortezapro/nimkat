<?php
namespace App\Services\Telegram;

use App\Services\Message\MessageService;
use App\Services\MessageReaction\MessageReactionService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update as UpdateObject;

class MessageReaction implements TelegramInterface{

    protected UpdateObject $update;
    protected UserService $userService;
    protected MessageReactionService $messageReactionService;

    public function __construct(UpdateObject $update)
    {
        $this->update = $update;
        $this->userService = App::make(UserService::class);
        $this->messageReactionService = App::make(MessageReactionService::class);
    }

    public function handle()
    {
        $messageId = $this->update->message_reaction->message_id;
        $userId = $this->update->message_reaction->user->id;
        $oldReaction = $this->update->message_reaction->old_reaction;
        $newReaction = $this->update->message_reaction->new_reaction;
        Log::info("newReaction".$newReaction);
        if(count($newReaction) != 0){
            Log::info("creating emoji");
//            Log::info($this->update);
            $object = json_decode($this->update);
            $logString = print_r($object);
            Log::info("decode: ".$logString);
//            Log::info("reaction-obj: ".$newReaction);
//            $emoji = $newReaction[0]["emoji"];
            //create
//            $data = [
//                "user_id" => $userId,
//                "message_id" => $messageId,
//                "reaction" => $emoji,
//            ];
//
//            $this->messageReactionService->store($data);
            Log::info("emoji created");

        } else {
            Log::info("removing emoji");
//            $messageReaction = $this->messageReactionService->find($messageId);
//            $this->messageReactionService->destroy($messageReaction);
            Log::info("emoji removed");
        }
    }
}
