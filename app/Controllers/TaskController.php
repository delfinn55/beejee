<?php

namespace App\Controllers;

use App\Core\Config;
use App\Core\Controller;
use App\Core\Pagination;
use App\Models\Task;
use App\Models\User;
use App\Views\View;
use Exception;

class TaskController extends Controller
{
    /**
     * Task model.
     *
     * @var Task
     */
    protected Task $model;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->model = new Task();
    }

    /**
     * Display all the tasks.
     *
     * @return bool|string
     * @throws Exception
     */
    public function index(): bool|string
    {
        $perPage = Config::get('tasks_per_page');

        $taskCount = $this->model->count();

        $order = [
            'order_by' => $_GET['order_by'] ?? '',
            'order_dir' => $_GET['order_dir'] ?? '',
        ];

        $page = Pagination::getPage($taskCount, $perPage);
        $tasks = $this->model->getFiltered($order, $perPage, ($page - 1) * $perPage);

        return View::make('index')
            ->with('tasks', $tasks)
            ->with('taskCount', $taskCount)
            ->with('limit', $perPage)
            ->with('order', $order)
            ->render();
    }

    /**
     * Display form for adding task.
     *
     * @return bool|string
     * @throws Exception
     */
    public function addForm(): bool|string
    {
        return View::make('tasks/add')->render();
    }

    /**
     * Add new task.
     *
     * @return bool|string|void
     * @throws Exception
     */
    public function create()
    {
        $data['userEmail'] = $_POST['userEmail'] ?? '';
        $data['userName'] = $_POST['userName'] ?? '';
        $data['taskDescription'] = $_POST['taskDescription'] ?? '';

        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        // Validation
        if (!empty($this->validationErrors($data))) {
            return View::make('tasks/add')->render();
        }

        $user = new User();
        $user_id = $user->upsert($data['userName'], $data['userEmail']);

        $task = new Task();
        $result = $task->insert($user_id, $data['taskDescription']);

        if ($result) {
            $_SESSION['flash']['success'] = ['Your task have created successfully!'];
        }

        header('Location: /');
        exit();
    }

    /**
     * Display form for editing task.
     *
     * @return bool|string
     * @throws Exception
     */
    public function editForm(): bool|string
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            header('Location: /');
            exit();
        }

        $task = new Task();
        $taskItem = $task->getById($_GET['id']);

        return View::make('tasks/edit')
            ->with('taskItem', $taskItem)
            ->render();
    }

    /**
     * Update the task.
     *
     * @return void
     */
    public function update(): void
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            $_SESSION['flash']['errors'] = ['You are have not permissions for editing the task. Please, log in.'];

            header('Location: /user/login');
            exit();
        }

        if (empty($_POST['taskId'])) {
            header('Location: /');
            exit();
        }

        $data['taskDescription'] = $_POST['taskDescription'] ?? '';
        $data['isDone'] = (isset($_POST['taskIsDone']) && $_POST['taskIsDone'] == 'on') ? 1 : 0;

        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        $task = new Task();
        $taskItem = $task->getById($_POST['taskId']);

        // Validation
        if (!empty($this->validationErrors($data))) {
            header('Location: /task/edit/?id=' . $taskItem['id']);
            exit();
        }

        $task->update($taskItem['id'], $data['taskDescription'], $data['isDone']);

        $_SESSION['flash']['success'] = ['Your task have updated successfully!'];

        header('Location: /');
        exit();
    }
}