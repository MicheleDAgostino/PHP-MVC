<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Mvc;

class ComingSoonController extends Controller {

    public function __construct(public Mvc $mvc)
    {
        parent::__construct($mvc);
        $this->setLayout('coming-soon');
    }

    public function index(){
        if (getenv('MAINTENANCE') === 'true') {
            $this->render('coming-soon');
        }else{
            $this->mvc->response->redirect('/');
        }
    }



}