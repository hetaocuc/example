<?php


namespace app\Controllers;
use app\Router;
use app\Models\Product;
use app\Models\Users;


class AdminController{

    
    public function index(Router $router)
    {
        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }

        $keyword = $_GET['search'] ?? '';

        $products = $router->database->getProducts($keyword);

        $title = "Admin";
        $router->renderView('admin/index', [

            'products' => $products,
            'keyword' => $keyword,
            'title' => $title,
            'session' => $router->session

        ]);


    }


    public function orders(Router $router){

        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }
        $keyword = $_GET['search'] ?? '';
        $orderUser=$router->database->getAllOrdersUser($keyword);

        $title = "Admin Orders";
        $router->renderView('admin/orders', [
            'keyword' =>    $keyword,
            'orderUser' => $orderUser,
            'title' => $title,
            'session' => $router->session

        ]);


    }
    
}