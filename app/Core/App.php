<?php

namespace App\Core;

class App
{
    /**
     * Router stores all the paths with correspond actions for application.
     *
     * @var Router
     */
    public Router $router;

    /**
     * Create a new application instance.
     */
    public function __construct()
    {
        $this->router = new Router();

        session_start();
    }

    /**
     * Run the application.
     *
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }
}