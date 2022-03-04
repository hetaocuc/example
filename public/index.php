<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\Router;
use app\Database;
use app\Controllers\ProductController;
use app\Controllers\UsersController;
use app\Controllers\HomeController;
use app\Controllers\AdminController;
use app\Controllers\OrderController;
use app\Controllers\CustomerController;
use app\Controllers\CartController;


use app\CheckLogin;

$database = new Database();
$session = new CheckLogin();
$router = new Router($database, $session);



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
$router -> post('/users/welcome', [UsersController::class,'welcome'] );
$router -> get('/users/logout', [UsersController::class,'logout'] );
$router -> post('/users/resetpassword', [UsersController::class,'resetpassword'] );
$router -> get('/users/resetpassword', [UsersController::class,'resetpassword'] );


/////////// Home
#####################################################################

$router -> get('/', [HomeController::class,'index'] );
$router -> get('/home', [HomeController::class,'index'] );
$router -> get('/home/about', [HomeController::class,'about'] );
$router -> get('/home/contact', [HomeController::class,'contact'] );
$router -> get('/home/details', [HomeController::class,'details'] );


/////////// Admin
#####################################################################
$router -> get('/admin', [ProductController::class,'index'] );
$router -> get('/admin/orders', [AdminController::class,'orders'] );




$router -> get('/customers', [CustomerController::class,'index'] );
$router -> get('/customers/update', [CustomerController::class,'update'] );
$router -> post('/customers/update', [CustomerController::class,'update'] );
$router -> post('/customers/delete', [CustomerController::class,'delete'] );


/////////// Cart
#####################################################################
$router -> post('/cart/add', [CartController::class,'add'] );
$router -> get('/cart', [CartController::class,'index'] );
$router -> post('/cart/delete', [CartController::class,'delete'] );
$router -> post('/cart/checkout', [CartController::class,'checkout'] );


/////////// Cart
#####################################################################
$router -> get('/order', [OrderController::class,'index'] );
$router -> get('/order/detail', [OrderController::class,'detail'] );



$router->resolve();

