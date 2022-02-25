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

        if(!CheckLogin::isLogin()){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }



        $keyword = $_GET['search'] ?? '';

        $products = $router->database->getProducts($keyword);
        $router->renderView('products/index', [
            'products' => $products,
            'keyword' => $keyword
        ]);


    }


    public  function create(Router $router){


        if(!CheckLogin::isLogin()){

            // Redirect to login page
             header("location: /users/login");
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

        $router -> renderView('Products/create', [
            'product' => $productData,
            'errors' => $errors
        ]);

    }


    public  function update(Router $router){

        if(!CheckLogin::isLogin()){

            // Redirect to login page
             header("location: /users/login");
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

        $router->renderView('products/update', [
            'product' => $productData
        ]);
    }



    public  function delete(Router $router){

        if(!CheckLogin::isLogin()){

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

