<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Pagination;
use App\Models\Task;
use App\Views\View;

class TaskController
{
    /**
     * Task model.
     *
     * @var Task
     */
    protected Task $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    /**
     * Display all the tasks.
     *
     * @return false|string|void
     */
    public function index()
    {
        $perPage = Config::get('tasks_per_page');

        $taskCount = $this->model->count();

        $page = Pagination::getPage($taskCount, $perPage);
        $tasks = $this->model->getFiltered($perPage, ($page - 1) * $perPage);

        return View::make('index',
            [
                'tasks'         => $tasks,
                'taskCount'     => $taskCount,
                'limit'         => $perPage,
            ]
        )->render();
    }
}