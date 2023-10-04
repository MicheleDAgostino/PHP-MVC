<?php

namespace App\Core;

use \App\Core\View;
use \App\Core\Database;
use \App\Core\Middleware;
use \App\Core\Http\Router;
use \App\Core\Http\Request;
use \App\Core\Http\Response;
use \App\Core\Exception\NotFoundException;

class Mvc {

    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;
    public Middleware $middleware;
    public \PDO $pdo;

    public function __construct(
        public array $config
    )
    {
        $this->request = new Request();
        $this->view = new View($this);
        $this->response = new Response($this->view);
        $this->router = new Router($this);
        $this->middleware = new Middleware($this, $config['middleware']);
        $this->getPdoConnection();
    }

    private function getPdoConnection(){
        try {
            $this->pdo = (new Database())->pdo;
        } catch (\PDOException $e) {
            echo 'Errore di connessione';
        }
    }

    public function run(){
        try {
            $this->router->resolve();
        } catch (NotFoundException $e) {
            $this->response->set404($e);
        }
        $this->response->send();
    }

}