<?php

use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Core\App;

const APP_DIR = __DIR__ . '/..';
const VIEWS_DIR = __DIR__ . '/../views';

require_once __DIR__ . '/../vendor/autoload.php';


/*
--------------------------------------------------------------------------
 Create The Application
--------------------------------------------------------------------------
*/

$app = new App();

/*
--------------------------------------------------------------------------
 Add necessary routes
--------------------------------------------------------------------------
*/

$app->router->addRoute('get', '/', [new TaskController(), 'index']);
$app->router->addRoute('get', '/task/add', [new TaskController(), 'addForm']);
$app->router->addRoute('post', '/task/create', [new TaskController(), 'create']);
$app->router->addRoute('get', '/task/edit', [new TaskController(), 'editForm']);
$app->router->addRoute('post', '/task/update', [new TaskController(), 'update']);

$app->router->addRoute('get', '/user/login', [new UserController(), 'loginForm']);
$app->router->addRoute('post', '/user/login', [new UserController(), 'login']);
$app->router->addRoute('post', '/user/logout', [new UserController(), 'logout']);

/*
--------------------------------------------------------------------------
 Run the application
--------------------------------------------------------------------------
*/
$app->run();