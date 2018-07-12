<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/bootstrap.php';

use App\Controllers\IndexController;

$app->get('/', IndexController::class.':index');
$app->get('/list', IndexController::class.':list');
$app->get('/download-csv', IndexController::class.':csv');
$app->get('/download-excel', IndexController::class.':xls');

$app->run();
