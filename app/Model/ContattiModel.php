<?php
namespace App\Model;
use \App\Core\Model;

class ContattiModel extends Model {

    public function __construct(public \PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function checkForm($post){
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (strlen($post['nome'] < 2 || strlen($post['messaggio'] < 10))) {
            return false;
        }

        return true;
    }

}