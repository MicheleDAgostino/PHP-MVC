<?php
use \App\Controller\HomeController;
use \App\Controller\ComingSoonController;
use App\Controller\TasksController;

return [

    'get' => [
        '/' => [HomeController::class, 'index'],
        '/coming-soon' => [ComingSoonController::class, 'index'],
        '/add-to-list' => [TasksController::class, 'index'],
        
    ],

    'post' => [
        '/add-to-list' => [TasksController::class, 'submit'],
        '/delete-task' => [HomeController::class, 'deleteTask']
    ],

];