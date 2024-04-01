<?php
namespace App\Services\Telegram;

use App\Models\MessageReactionModel;
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
        Log::info("creating emoji");
        if (isset($this->update->message_reaction)) {
            $emoji="default";
            $reaction = $this->update->message_reaction;
            if (isset($reaction->new_reaction) && !empty($reaction->new_reaction)) {
                if (count($newReaction) > 0 && is_array($newReaction[0])) {
                    $emoji = $newReaction[0]["emoji"];
                }
                $data = [
                    "user_id" => $userId,
                    "message_id" => $messageId,
                    "reaction" => $emoji,
                ];
                MessageReactionModel::firstOrCreate($data);
//                $this->messageReactionService->store($data);
                    Log::info("emoji created");
                }

        }
//        else {
//            Log::info("removing emoji");
//            $messageReaction = $this->messageReactionService->find($messageId);
//            $this->messageReactionService->destroy($messageReaction);
//            Log::info("emoji removed");
//        }
    }
}
