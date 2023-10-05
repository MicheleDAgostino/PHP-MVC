<?php
use \App\Controller\HomeController;
use \App\Controller\ComingSoonController;
use \App\Controller\AddToListController;

return [

    'get' => [
        '/' => [HomeController::class, 'index'],
        '/coming-soon' => [ComingSoonController::class, 'index'],
        '/add-to-list' => [AddToListController::class, 'index']
    ],

    'post' => [
        '/add-to-list' => [AddToListController::class, 'submit']
    ],

];