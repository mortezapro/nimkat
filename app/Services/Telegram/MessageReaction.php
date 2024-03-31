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
        Log::info("message id: ".$messageId);
        Log::info("user id: ".$userId);
        Log::info("old reaction: ".$oldReaction);
        Log::info("new reaction: ".$newReaction[0]["emoji"]);
    }
}
