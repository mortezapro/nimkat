<?php
namespace App\Services\Telegram;

class TelegramService{
    protected $update;
    public function __construct($update)
    {
        $this->update = $update;
    }

    public function handle()
    {
        foreach ($this->update as $name => $value) {
            $normalizedName = ucfirst($name);
            $namespace = 'App\Services\Telegram';
            $class = $namespace . "\\{$normalizedName}";

            if (! class_exists($class)) {
                continue;
            }

            if (strlen($value)) {
                (new $class($this->update))->handle($value);
            } else {
                (new $class($this->update))->handle();
            }
        }

        return "ok";
    }
}
