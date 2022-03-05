<?php
namespace app\Controllers;

use app\Router;
use app\Models\Product;
use app\helpers\CheckLogin;


class ProductController{


    public  function index(Router $router){

        //////////////////
        // echo '<pre>';
        // echo var_dump($router);
        // echo '</pre>';
        //////////////////////////////



        if(!$router->session->loggedin || ($router->session->role===0)){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }


          
        $keyword = $_GET['search'] ?? '';

        // $products = $router->database->getProducts($keyword);


        $total = $router->database->getProductTotal();

        // How many items to list per page
        $limit = 10;

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

        $title = "Product";
        $router->renderView('products/index', [
            'products' => $products,
            'keyword' => $keyword,
            'pager' => $pager,
            'title' => $title,
            'session' => $router->session
        ]);
    }


    public  function create(Router $router){


     

        if(!$router->session->loggedin){


            // Redirect to login page
             header("location: /users/login?url=/products");
             exit;
        }


        $errors = [];
        $productData = [

            'title' => '',
            'description' => '',
            'image' => '',
            'price' => ''


        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);



            $errors = $product->save();

            if(empty($errors))
            {
                header('Location: /products');
                exit;
    
            }


        }

        $title = "Create";
        $router -> renderView('Products/create', [
            'product' => $productData,
            'errors' => $errors,
            'title' => $title,
            'session' => $router->session
        ]);

    }


    public  function update(Router $router){

    

        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login?url=/products");
             exit;
        }


        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }
        $productData = $router->database->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);
            $product->save();
            header('Location: /products');
            exit;
        }

        $title = "Update";

        $router->renderView('products/update', [
            'product' => $productData,
            'title' => $title,
            'session' => $router->session
        ]);
    }



    public  function delete(Router $router){



        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }


        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }

        if ($router->database->deleteProduct($id)) {
            header('Location: /products');
            exit;
        }
    }




}

