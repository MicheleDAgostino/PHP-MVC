<?php
namespace App\Controller;
use \App\Core\Controller;
use \App\Core\Component;
use \App\Core\Mvc;
use \App\Model\HomeModel;
use \App\Model\ContattiModel;

class HomeController extends Controller {

    public function __construct(public Mvc $mvc)
    {
        parent::__construct($mvc);
    }

    public function index(){

        $homeModel = new HomeModel($this->mvc->pdo);
        $items = $homeModel->find('home');

        $this->render('home', [
            'form' => $this->getFormComponent(),
            'message' => '',
            'homeitem' => $this->getHomeComponent($items)
        ]);
    }

    public function getFormComponent(){
        $form = new Component('formcontatti');
        $form->setItem([]);
        return $form;
    }

    private function getHomeComponent($items){
        $homeComponent = new Component('homeitem');
        $homeComponent->setItems($items);
        return $homeComponent;
    }

    public function submit(){
        $this->render('home', [
            'message' => $this->sendForm(),
            'form' => $this->getFormComponent()
        ]);
    }

    public function sendForm(){
        $model = new ContattiModel($this->mvc->pdo);
        $post = $this->mvc->request->getPost();

        if ($model->checkForm($post)) {
            $model->save('contatti', $post);
            return 'Il messaggio è stato inviato!';
        }

        return 'Controllare la correttezza dei campi.';
        
    }

}