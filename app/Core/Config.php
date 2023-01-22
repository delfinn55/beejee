<?php

namespace App\Core;

class Config
{
    /**
     * Settings.
     *
     * @var array
     */
    private static array $config = [];

    /**
     * Initialization. Retrieve settings from files.
     *
     * @return void
     */
    public static function init(): void
    {
        self::$config = array_merge(
            include( APP_DIR . '/config/database.php' ),
            include( APP_DIR . '/config/tasks.php' ),
        );
    }

    /**
     * Get the config value.
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return self::$config[$key];
    }

    /**
     * Set the config value.
     *
     * @param string $key
     * @param $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        self::$config[$key] = $value;
    }
}