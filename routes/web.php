<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});

Route::post('v1/telegram/webhook', [TelegramController::class,"handleWebhook"]);

Route::get('/setWebhook', function () {
    $url = 'https://103.75.199.54/v1/telegram/webhook';
    $response = Telegram::setWebhook([
        'url' => $url,
        'allowed_updates' => ['message', "callback_query","chat_member","message_reaction","message_reaction_count","edited_message"],
        'encoding' => 'UTF-8',
    ]);

    echo $url;
    return $response == true ? 'Webhook URL set!' : 'Failed to set webhook URL!';
});

Route::get('/removeWebhook', function () {
    $response = Telegram::removeWebhook();
    return $response == true ? 'Webhook URL removed!' : 'Failed to remove webhook URL!';
});

Route::get('/update', function () {
    $response = Telegram::getUpdates();
    dd($response);
});
