<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Component;
use \App\Core\Mvc;
use \App\Model\TasksModel;

class TasksController extends Controller {
    
    public function __construct(public Mvc $mvc)
    {
        parent::__construct($mvc);
    }
    
    public function index(){
        
        $this->render('add-to-list', [
            'form' => $this->getFormComponent(),
            'message' => ''
        ]);
    }
    
    public function getFormComponent(){
        $form = new Component('form');
        $form->setItem([]);
        return $form;
    }
    
    public function submit(){
        $this->render('add-to-list', [
            'form' => $this->getFormComponent(),
            'message' => $this->sendForm(),
        ]);
    }
    
    public function sendForm(){
        $model = new TasksModel($this->mvc->pdo);
        $post = $this->mvc->request->getPost();
        $model->save('tasks', $post);
        return 'Task inserito con successo!';
    }

    
}