<?php
use \App\Controller\HomeController;
use \App\Controller\ComingSoonController;

return [

    'get' => [
        '/' => [HomeController::class, 'index'],
        '/coming-soon' => [ComingSoonController::class, 'index']
    ],

    'post' => [
        '/' => [HomeController::class, 'submit']
    ],

];