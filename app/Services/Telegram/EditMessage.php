<?php
namespace App\Services\Telegram;

use App\Models\MessageModel;
use App\Services\Message\MessageService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update as UpdateObject;

class EditMessage implements TelegramInterface {

    protected UpdateObject $update;
    protected MessageService $messageService;
    public function __construct(UpdateObject $update)
    {
        $this->update = $update;
        $this->messageService = App::make(messageService::class);
    }

    public function handle()
    {
        Log::info("updating message");
        Log::info($this->update);
        $messageData = [
            "text"      => (string)$this->update->editedMessage->text,
        ];
        $this->messageService->update($messageData,$this->update->editedMessage->messageId);
        Log::info("message updated");
    }
}
