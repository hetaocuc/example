<?php


namespace app\Controllers;

use app\helpers\UtiHelper;
use app\Router;
use app\Models\Product;
use app\Models\Users;
use app\Models\Cart;
use app\Models\Order;


class CartController{

    public function index(Router $router)
    {
        if(!$router->session->loggedin){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login");

             exit;
        }

        $cartData['user_id'] = $router->session->id;
        $cartData['checkout'] = false;
        $c = new Cart($cartData);

       // $keyword = $_GET['search'] ?? '';

        $cartData = $router->database->getCartLists($c);
        

        // $cart = new Cart($cartGet);



        $title = "Cart";
        $router->renderView('cart/index', [

            'carts' => $cartData,
            'title' => $title,
            'session' => $router->session

        ]);


    }



    public function add(Router $router)
    {
        if(!$router->session->loggedin){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login");

             exit;
        }


        $errors = [];
        $cartData = [

            'user_id' => 0,
            'product_id' => 0,
            'quantity' => 0
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cartData['user_id'] = $router->session->id;
            $cartData['product_id'] = $_POST['id'];
            $cartData['quantity'] = $_POST['quantity'] ?? 1;

            $cartData['total_price'] = 0;
            $cartData['$checkout'] = 0;
            $cartData['sn'] = 'null';

            $cart = new Cart($cartData);


            $num = $router->database->getCartQuantity($cart);
                           
            if ($num >= 1){

                $cart->quantity = $num +1;
                $router->database->updateCartQuantity($cart);


            }
            else{
                $router->database->addCart($cart);
            }



                header("location: /cart");



            
        }

    }

    public function delete(Router $router)
    {
        if(!$router->session->loggedin){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login");

             exit;
        }


        $errors = [];
        $cartData = [

            'user_id' => 0,
            'product_id' => 0,
            'quantity' => 0
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cartData['user_id'] = $router->session->id;
            $cartData['product_id'] = $_POST['id'];
 


            $cart = new Cart($cartData);

               echo var_dump($cart);
            
            if(isset($_POST["delete"]) ){

            if($router->database->deleteCart($cart)){

                header("location: /cart");
            }
            else{

                echo "Delete Cart error.";
            }
        }
        }

    }


    public function checkout(Router $router){

        $cartData = [

            'user_id' => 0,
            'product_id' => 0,
            'quantity' => 0
        ];

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cartData['user_id'] = $router->session->id;

            $cart = new Cart($cartData);
            $order = new Order();
            $order->user_id = $router->session->id;


 

            if(isset($_POST["checkout"]) ){

                $cart->sn = UtiHelper::createOrderNum();
                $order->order_id = $cart->sn;
                $totalPrice = 0.0;
//////////////////////////////////////////////////////
                foreach($_REQUEST['product_id'] as $id){

                    $cart->product_id = $id;
                    $cart->checkout = true;

                    $router->database->cartCheckout($cart);
                    $totalPrice = $totalPrice + $router->database->getCartTotalPrice($cart);
      
                }
                
                $order->total_price = $totalPrice;
                $router->database->addOrder($order);

                header("location: /order");

            }

            if(isset($_POST["delete"]) ){


                $cart->product_id = $_REQUEST['id'];
                if($router->database->deleteCart($cart)){
    
                     header("location: /cart");
                }
                else{
    
                    echo "Delete Cart error.";
                }
            }




    }
}

}



