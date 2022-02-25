<?php


namespace app\Controllers;

use app\Router;
use app\Models\Product;
use app\Models\Users;

class HomeController{


    public function index(Router $router)
    {

        $keyword = $_GET['search'] ?? '';

        $products = $router->database->getProducts($keyword);

        $title = "Home";
        $router->renderView('/home/index', [
            'products' => $products,
            'keyword' => $keyword,
            'title' => $title
        ]);


    }

    public function contact(Router $router)
    {

        $title = "Contact";
        $router->renderView('/home/contact', [
            'title' => $title
        ]);
    }


    public function about(Router $router)
    {
        $title = "About";

        $router->renderView('/home/about', [
            'title' => $title
        ]);
    }



}