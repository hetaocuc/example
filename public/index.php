<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\Router;
use app\Database;
use app\Controllers\ProductController;
use app\Controllers\UsersController;
use app\Controllers\HomeController;

$database = new Database();
///////////////////
// echo '<pre>';
// echo var_dump($database);
// echo '</pre>';
/////////////////////

$router = new Router($database);

///// Product
###############################################################

$router -> get('/products', [ProductController::class,'index'] );
$router -> get('/products/create', [ProductController::class,'create'] );
$router -> post('/products/create', [ProductController::class,'create'] );
$router -> get('/products/update', [ProductController::class,'update'] );
$router -> post('/products/update', [ProductController::class,'update'] );
$router -> post('/products/delete', [ProductController::class,'delete'] );

/////////// User
#####################################################################
$router -> get('/users/signup', [UsersController::class,'signup'] );
$router -> post('/users/signup', [UsersController::class,'signup'] );
$router -> get('/users/login', [UsersController::class,'login'] );
$router -> post('/users/login', [UsersController::class,'login'] );
$router -> get('/users/welcome', [UsersController::class,'welcome'] );
$router -> get('/users/logout', [UsersController::class,'logout'] );
$router -> post('/users/resetpassword', [UsersController::class,'resetpassword'] );
$router -> get('/users/resetpassword', [UsersController::class,'resetpassword'] );


/////////// Home
#####################################################################

$router -> get('/', [HomeController::class,'index'] );
$router -> get('/home', [HomeController::class,'index'] );
$router -> get('/home/about', [HomeController::class,'about'] );
$router -> get('/home/contact', [HomeController::class,'contact'] );




$router->resolve();