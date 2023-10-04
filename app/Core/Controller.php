<?php
namespace App\Core;
use \App\Core\Mvc;

class Controller {

    public function __construct(public Mvc $mvc)
    {
        
    }

    public function setLayout($layout){
        $this->mvc->view->layout = $layout;
    }

    public function render($view, $values = []){
        $content = $this->mvc->view->render($view, $values);
        $this->mvc->response->setContent($content);
    }

}