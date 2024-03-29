<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/telegram/webhook', [TelegramController::class,"handleWebhook"]);

Route::get('/setWebhook', function () {
    $url = 'https://103.75.199.54/api/telegram/webhook';
    $response = Telegram::setWebhook([
        'url' => $url,
        'allowed_updates' => ['message', "edited_channel_post", "callback_query","chat_member","message_reaction","message_reaction_count","edited_message","my_chat_member","chat_member"]]);
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



Route::get('/', function () {
    return view('welcome');
});


