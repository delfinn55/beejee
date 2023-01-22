<?php

namespace App\Core;

class Request
{
    /**
     * Array of url parts.
     *
     * @var array
     */
    public array $urlComponents;

    /**
     * Request method.
     */
    public string $method;

    /**
     * Create a new request instance.
     */
    public function __construct()
    {
        $this->urlComponents = parse_url($_SERVER['REQUEST_URI']);

        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get method.
     *
     * @return mixed|string
     */
    public function getPath(): mixed
    {
        return $this->urlComponents['path'];
    }


    /**
     * Get arguments.
     *
     * @return mixed|string
     */
    public function getParams(): mixed
    {
        return $this->urlComponents['query'];
    }

    /**
     * Get method.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}