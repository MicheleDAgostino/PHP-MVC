<?php

namespace App\Core\Http;

use \App\Core\Exception\NotFoundException;
use \App\Core\Http\Request;
use \App\Core\Mvc;

class Router {

    public function __construct(public Mvc $mvc){}

    public function getRoute(){
        $method = $this->mvc->request->getRequestMethod();
        $path = $this->mvc->request->getRequestPath();
        $routes = $this->mvc->config['routes'];
        return $routes[$method][$path] ?? false;

    }

    public function resolve(){
        $response = $this->getRoute();
        if(!$response) throw new NotFoundException();
        $this->dispatch($response);
    }

    public function dispatch($response){
        $controller = $response[0];
        $action = $response[1];
        $instance = new $controller($this->mvc);
        $this->mvc->middleware->execute();
        call_user_func_array([$instance, $action], []);
    }

}