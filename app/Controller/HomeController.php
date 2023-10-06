<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Component;
use \App\Core\Mvc;
use \App\Model\HomeModel;

class HomeController extends Controller {
    
    public function __construct(public Mvc $mvc)
    {
        parent::__construct($mvc);
    }
    
    public function index(){
        
        $homeModel = new HomeModel($this->mvc->pdo);
        $items = $homeModel->find('tasks');
        
        $this->render('home', [
            'homeitem' => $this->getHomeComponent($items)
        ]);
    }
    
    private function getHomeComponent($items){
        $homeComponent = new Component('homeitem');
        $homeComponent->setItems($items);
        return $homeComponent;
    }
    
    public function deleteTask(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $homeModel = new HomeModel($this->mvc->pdo);
            $homeModel->delete('tasks', $id);
            $items = $homeModel->find('tasks');
            
            $this->render('home', [
                'homeitem' => $this->getHomeComponent($items)
            ]);
            
        }
    }
    
    
    
}