<?php 
namespace App\Middleware;
use \App\Contract\MiddlewareInterface;
use \App\Core\Mvc;

class MaintenanceMiddleware implements MiddlewareInterface {

    public function exec(Mvc $mvc){
        if (getenv('MAINTENANCE') === 'true' && $mvc->request->getRequestPath() !== '/coming-soon') {
            $mvc->response->redirect('/coming-soon');
        }
    }

}