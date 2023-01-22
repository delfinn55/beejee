<?php

namespace App\Views;

class View
{
    /**
     * View name.
     *
     * @var string
     */
    protected string $view;

    /**
     * Passed parameters.
     * @var array
     */
    protected array $params;

    /**
     * Create the instance of view.
     *
     * @param string $view
     * @param array $params
     */
    public function __construct(
        string $view,
        array $params = []
    ) {
        $this->view = $view;
        $this->params = $params;
    }

    /**
     * Create a new View instance.
     *
     * @param string $view
     * @param array $params
     * @return static
     */
    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    /**
     * Get the content.
     *
     * @return false|string|void
     */
    public function render()
    {
        $viewPath = VIEWS_DIR . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            die('View not found');
        }

        // Extract the params
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include $viewPath;

        return ob_get_clean();
    }
}