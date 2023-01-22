<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Pagination;
use App\Models\Task;
use App\Models\User;
use App\Views\View;
use Exception;

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
     * @throws Exception
     */
    public function index()
    {
        $perPage = Config::get('tasks_per_page');

        $taskCount = $this->model->count();

        $page = Pagination::getPage($taskCount, $perPage);
        $tasks = $this->model->getFiltered($perPage, ($page - 1) * $perPage);

        return View::make('index')
            ->with('tasks', $tasks)
            ->with('taskCount', $taskCount)
            ->with('limit', $perPage)
            ->render();
    }

    /**
     * Display form for adding task.
     *
     * @throws Exception
     */
    public function add(): bool|string
    {
        return View::make('tasks/add')->render();
    }

    public function create()
    {
        $data['userEmail'] = $_POST['userEmail'] ?? '';
        $data['userName'] = $_POST['userName'] ?? '';
        $data['taskDescription'] = $_POST['taskDescription'] ?? '';

        if (!empty($errors = $this->validationErrors($data))) {
            return View::make('tasks/add')->render();
        }

        $_SESSION['flash']['successMessages'] = ['Your task have created successfully!'];

        header('Location: /');
    }

    protected function validationErrors($data): array
    {
        $errors = [];

        // Email
        if (empty($data['userEmail'])) {
            $errors[] = 'User email is required';
        }
        if (!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address';
        }

        // Name
        if (empty($data['userName'])) {
            $errors[] = 'User name is required';
        }
        if (!preg_match ("/^[0-9a-zA-z]*$/", $data['userName'])) {
            $errors[] = 'Not valid name. Use alphabets and numbers only';
        }

        // Description
        if (empty($data['taskDescription'])) {
            $errors[] = 'Description is required';
        }
        if (strlen($data['taskDescription']) < 3) {
            $errors[] = 'Description must be at least 3 characters';
        }

        $_SESSION['flash']['validateErrors'] = $errors;

        return $errors;
    }
}