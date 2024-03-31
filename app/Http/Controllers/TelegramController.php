<?php

namespace App\Http\Controllers;

use App\Services\Telegram\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Get the incoming message from Telegram
        $update = Telegram::commandsHandler(true);
        Log::info('update: ' . json_encode($update));
        // Check if the command "/getAllMessage" is received
        if ($update->getMessage() && $update->getMessage()->text == '/getAllMessage') {
            // Retrieve all messages from the group
            $chatId = $update->getMessage()->chat->id;
            $messages = Telegram::getChatMessages(['chat_id' => $chatId]);

            // Process and store the messages as needed
            // Example: Log the messages
            Log::info('All group messages: ' . json_encode($messages));
        }
    }
    public function handleWebhook(Request $request)
    {
        $action = "";
        $bot = new Api(env('TELEGRAM_BOT_TOKEN'));
        $update = $bot->getWebhookUpdate();
        if (isset($update->message)) {
            Log::info("create");
        }
        if (isset($update->edited_message)){
            Log::info("edit");
        }


//        $telegram = new TelegramService($update,$action);
//        $telegram->handle();
//	    Log::info($update->message_reaction);
//        if (isset($update->message)) {
//		    Log::info("Message: ".$update->message->text);
//		    Log::info("Username: ".$update->message->from->username);
//		    Log::info("Username: ".$update->message->from->username);
//		    Log::info("FirstName: ".$update->message->from->firstName);
//		    Log::info("LastName: ".$update->message->from->lastName);
//		    Log::info("id: ".$update->message->from->id);
//		    Log::info("message: ".$update->message->messageId);
//		    Log::info("chatId: ".$update->getChat()->get("id"));
//		    Log::info("chatId: ".$update);
//        }
	    return response('OK', 200);
    }

	public function test()
	{
		$response = Telegram::bot('nimkat_api_bot')->getMe();
		dd($response);
	}
}
