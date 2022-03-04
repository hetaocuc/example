<?php


namespace app\Controllers;
use app\Router;
use app\Models\Product;
use app\Models\Users;
use app\Models\Order;
use app\Models\Cart;


class OrderController{

    
    public function index(Router $router)
    {
        if(!$router->session->loggedin){ // Administrator role=1; Guest role = 0;


            // Redirect to login page
            header("location: /users/login?url=/products");

             exit;
        }

        $order = new Order();
        $order->user_id = $router->session->id;

        $orderData = $router->database->getOrderLists($order);


        $title = "Order";
        $router->renderView('orders/index', [

            'orders' => $orderData,
            'title' => $title,
            'session' => $router->session

        ]);


    }

    public function detail(Router $router){

       

        $user = new Users();
        $user->id = $router->session->id; 

        if(!$router->session->loggedin){

            // Redirect to login page
             header("location: /users/login");
             exit;
        }

        $cartData=[];

    
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            $cartData['user_id']= $router->session->id;
            $cartData['sn']= $_GET['id'];
            $cart = new Cart($cartData);
            $p = $router->database->getCartOrderDetail($cart);



            $userData = $router->database->getUserInformation($user->id);
 
      
            // $user->full_name = $userData['full_name'];
            // $user->email = $userData['email'];
            // $user->mobile = $userData['mobile'];
            // $user->address = $userData['address'];
            // $user->city = $userData['city'];




        }


        






        $title = "Order detail";
        $router->renderView('orders/detail', [
            'user' => $userData,
            'products' => $p,
            'title' => $title,
            'session' => $router->session

        ]);

    }
}