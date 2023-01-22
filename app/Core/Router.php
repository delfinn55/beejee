<?php

namespace App\Core;

class Router
{
    /**
     * Array of registered routes.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Incoming request.
     *
     * @var Request
     */
    public Request $request;

    /**
     * Create a new router instance.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Register new route with its callback.
     *
     * @param $method
     * @param $path
     * @param $callback
     * @return void
     */
    public function addRoute($method, $path, $callback): void
    {
        $this->routes[$method][$path] = $callback;
    }

    /**
     * Search current request's path in routes.
     * Perform correspond action if it's possible.
     *
     * @return mixed|string
     */
    public function resolve(): mixed
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        return isset($this->routes[$method][$path])
            ? call_user_func($this->routes[$method][$path])
            : '404 page';
    }
}