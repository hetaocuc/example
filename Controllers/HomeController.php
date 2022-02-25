<?php


namespace app\Controllers;

use app\Router;
use app\Models\Product;
use app\Models\Users;

class HomeController{


    public function index(Router $router)
    {



        $router->renderView('/home/index', [

        ]);
    }

    public function contact(Router $router)
    {

        $router->renderView('/home/contact', [

        ]);
    }


    public function about(Router $router)
    {

        $router->renderView('/home/about', [

        ]);
    }



}