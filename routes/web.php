<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
use App\Models\MessageReactionModel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource("messages",MessageController::class);
    Route::resource("users",UserController::class);
});

require __DIR__.'/auth.php';


Route::post('v2/telegram/webhook', [TelegramController::class,"handleWebhook"]);

Route::get('/setWebhook', function () {
    $url = 'https://103.75.199.54/v2/telegram/webhook';
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
