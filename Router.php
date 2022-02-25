<?php

namespace app;
use app\Controllers\ProductController;
use app\Controllers\UsersController;
use app\Controllers\HomeController;
use app\helpers\CheckLogin;

class Router{

    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $database;

    public function __construct(Database $db){

        ///////////////////
        // echo '<pre>';
        // echo var_dump($db);
        // echo '</pre>';
        /////////////////////
        $this -> database = $db; 

    }
    public function get($url, $fn){

        $this->getRoutes[$url] = $fn ;

    }

    public function post($url, $fn){

        $this->postRoutes[$url] = $fn ;
    }

    public function resolve(){

         $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
         $method = strtolower($_SERVER['REQUEST_METHOD']);




        if($method === 'get'){

            $fn = $this->getRoutes[$currentUrl] ?? NULL;

        }else{

            $fn = $this->postRoutes[$currentUrl] ?? NULL;
        }


///        echo var_dump($fn);

        if($fn){

            //call_user_func($fn);         //////

            try {
                //code...
                $p = new $fn[0]();
                call_user_func(array($p,$fn[1]),$this);

            } catch (\Throwable $th) {
                throw $th;

            }


        }
        else{

            echo "Page not found! found by router";
            echo var_dump($fn);
        }


    }
    public function renderView($view, $params = []){

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        

        ob_start();
        include_once __DIR__."/views/$view.php";
        $content = ob_get_clean();


        $title = $view;
        // if(CheckLogin::isLogin()){
        //     $logstatus = "logout";
        // }
        // else{
        //     $logstatus = "login";
        // }


        include_once __DIR__.'/views/_layout.php';




    }



}


