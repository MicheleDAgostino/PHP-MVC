<?php
namespace App\Core;
use \App\Core\Mvc;

class Middleware {

    public function __construct(
        public Mvc $mvc, 
        public array $queueForBaseRoute = [],
        public array $queueRoute = []
    )
    {
        
    }

    public function register($middleware){
        array_push($this->queueRoute, $middleware);
    }

    public function execute(){
        $request = $this->mvc->request->getRequestPath();
        foreach($this->queueForBaseRoute as $basePath => $middlewareGroup){
            if (str_starts_with($request, $basePath)) {
                $this->executeMiddleware($middlewareGroup);
            }
        }
        $this->executeMiddleware($this->queueRoute);
    }

    private function executeMiddleware($middlewares){
        foreach ($middlewares as $middleware) {
            (new $middleware)->exec($this->mvc);
        }
    }

}