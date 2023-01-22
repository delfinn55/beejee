<?php

namespace App\Core;

class Config
{
    private static array $config = [
        'per_page' => 3,
        'db_host' => 'localhost',
        'db_name' => 'bee',
        'db_user' => 'root',
        'db_pass' => 'root',
    ];

    public static function get(string $key)
    {
        return self::$config[$key];
    }

    public static function set(string $key, $value): void
    {
        self::$config[$key] = $value;
    }
}