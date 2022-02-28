<?php

namespace app;
use app\Controllers\ProductController;
use app\Controllers\UsersController;
use app\Controllers\HomeController;
use app\Controllers\AdminController;
use app\CheckLogin;

class Router{

    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $database;

    public CheckLogin $session;

    public function __construct(Database $db, CheckLogin $s){

        ///////////////////
        // echo '<pre>';
        // echo var_dump($db);
        // echo '</pre>';
        /////////////////////
        $this -> database = $db; 
        $this -> session = $s;

    }
    public function get($url, $fn){

        $this->getRoutes[$url] = $fn ;

    }

    public function post($url, $fn){

        $this->postRoutes[$url] = $fn ;
    }

    public function resolve(){

         $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
           
        //    echo var_dump( $_SERVER);
        //    echo var_dump($currentUrl);

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

            echo "Page not found! found by router".'<br>';
            echo '$_SERVER["PATH_INFO"]   ';

            echo  $_SERVER['PATH_INFO'] ?? null;
            echo '<br>';
            echo '$_SERVER["REQUEST_URI"]'.'<br>';
            echo  $_SERVER['REQUEST_URI'] ?? null;

        }


    }
    public function renderView($view, $params = []){

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__."/views/$view.php";
        $content = ob_get_clean();

        $layout = explode("/", $view);
        // echo var_dump($layout[0]);
        //include_once __DIR__.'/views/_layout.php';
        include_once __DIR__."/views/$layout[0]/_layout.php";




    }



}


