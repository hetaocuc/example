<?php


namespace app\Controllers;

use app\Router;
use app\Models\Product;
use app\Models\Users;

class HomeController{


    public function index(Router $router)
    {

        $keyword = $_GET['search'] ?? '';

       // $products = $router->database->getProducts($keyword);

        $total = $router->database->getProductTotal();

        // How many items to list per page
        $limit = 9;

        // How many pages will there be
        $pages = ceil($total['COUNT(*)'] / $limit);

        // What page are we currently on?
        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));
        // Calculate the offset for the query
        $offset = ($page - 1)  * $limit;

        // Some information to display to the user
        $start = $offset + 1;
        $end = min(($offset + $limit), $total);

        $pager = [];

        $pager['pages']= $pages;
        $pager['page'] = $page;
        $pager['start'] = $start;
        $pager['end'] = $end;
        $pager['total'] = $total['COUNT(*)'];
        $pager['limit'] = $limit;
        $pager['offset'] = $offset;



        $products = $router->database->getProducts( );
        if(!empty($products)){
            $products = $router->database->getPagedProduct( $pager['limit'],$pager['offset']);

        }



        $title = "Home";
        $router->renderView('home/index', [
            'products' => $products,
            'keyword' => $keyword,
            'pager' => $pager,
            'title' => $title,
            'session' => $router->session
        ]);


    }

    public  function details(Router $router){

        $id = $_GET['id'];

        $productData = $router->database->getProductById($id);



        $title = "Details";

        $router->renderView('home/details', [

            'productData' => $productData,
            'title' => $title,
            'session' => $router->session


        ]);
    
    
    }


    public function contact(Router $router)
    {

        $title = "Contact";
        $router->renderView('home/contact', [
            'title' => $title,
            'session' => $router->session
        ]);
    }


    public function about(Router $router)
    {
        $title = "About";

        $router->renderView('home/about', [
            'title' => $title,
            'session' => $router->session
        ]);
    }



}