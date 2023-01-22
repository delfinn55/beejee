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

/*
--------------------------------------------------------------------------
 Run the application
--------------------------------------------------------------------------
*/
$app->run();