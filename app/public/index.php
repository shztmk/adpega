<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

$router = new \Pkg\Router\Router();
$router->add(
    \Pkg\Router\HttpMethod::Get,
    '/',
    \Adpega\App\Adapter\Http\ExampleController::class,
    'index',
);
$dispatcher = new \Pkg\Router\Dispatcher();
$result = $dispatcher->dispatch($router);

echo $result;
