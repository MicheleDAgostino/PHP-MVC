<?php
namespace App\Contract;
use \App\Core\Mvc;

interface MiddlewareInterface {

    public function exec(Mvc $mvc);
    
}