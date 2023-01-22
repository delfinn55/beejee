<?php

namespace App\Views;

use Exception;

class View
{
    /**
     * The path of the view file.
     *
     * @var string
     */
    private string $filePath;

    /**
     * The data passed to the view.
     *
     * @var array
     */
    private array $data = [];

    /**
     * Create a new application instance.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = VIEWS_DIR . '/' . $filePath . '.php';
    }

    /**
     * Add data to the view.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function with($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Render the view
     *
     * @throws Exception
     */
    public function render(): bool|string
    {
        if (!file_exists($this->filePath)) {
            throw new Exception("View not found at path {$this->filePath}");
        }

        extract($this->data);
        ob_start();
        include $this->filePath;
        return ob_get_clean();
    }

    /**
     * Create an instance of the View class.
     *
     * @param string $filePath
     * @return View
     */
    public static function make(string $filePath): View
    {
        return new View($filePath);
    }
}