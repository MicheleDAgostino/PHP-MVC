<?php
require_once __DIR__.'/vendor/autoload.php';
use \App\Core\Mvc;
use \App\Core\Config;

Config::env(__DIR__.'/.env');
$config = Config::dir(__DIR__.'/config');

(new Mvc($config))->run();