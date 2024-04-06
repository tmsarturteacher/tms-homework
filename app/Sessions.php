<?php

namespace App;

class Sessions
{
    public function start(): void
    {
        session_start();
    }

    public function get(string $key): ?array
    {
        return !empty($_SESSION[$key]) ? $_SESSION : null;
    }

    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function save(): void
    {
        session_write_close();
    }

    public function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function flush(string $key): ?array
    {
        $value = $this->get($key);
        $this->unset($key);

        return $value;
    }
}