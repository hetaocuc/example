<?php


namespace app\Controllers;
use app\Router;
use app\Models\Product;
use app\Models\Users;


class OrderController{

    
    public function index(Router $router)
    {
        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }

 



        $title = "Order";
        $router->renderView('order/index', [

            'title' => $title,
            'session' => $router->session

        ]);


    }
}