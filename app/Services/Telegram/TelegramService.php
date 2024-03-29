<?php
namespace App\Services\Telegram;

class TelegramService{
    protected $update;
    protected $action;
    public function __construct($update,array $action)
    {
        $this->update = $update;
        $this->action = $action;
    }

    public function handle()
    {
        foreach ($this->action as $value) {
            $normalizedName = ucfirst($value);
            $namespace = 'App\Services\Telegram';
            $class = $namespace . "\\{$normalizedName}";

            if (! class_exists($class)) {
                continue;
            }

            (new $class($this->update))->handle();
        }
    }
}
