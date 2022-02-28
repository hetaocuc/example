<?php


namespace app\Controllers;
use app\Router;
use app\Models\Product;
use app\Models\Users;


class CustomerController{

    
    public function index(Router $router)
    {
        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }

 



        $title = "Customer";
        $router->renderView('customer/index', [

            'title' => $title,
            'session' => $router->session

        ]);


    }
}