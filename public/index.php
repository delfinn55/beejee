<?php

use App\Controllers\TaskController;
use App\Core\App;

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
$app->router->addRoute('get', '/task/add', [new TaskController(), 'add']);
$app->router->addRoute('post', '/task/create', [new TaskController(), 'create']);

/*
--------------------------------------------------------------------------
 Run the application
--------------------------------------------------------------------------
*/
$app->run();