<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../bootstrap.php';
define('APPNAME', 'Xengji');

session_start();

$router = new \Bramus\Router\Router();


$router->setNamespace('\App\Controllers');
$router->post('/logout', 'Auth\LoginController@logout');
$router->get('/register', 'Auth\RegisterController@showRegisterForm');
$router->post('/register', 'Auth\RegisterController@register');
$router->get('/login', 'Auth\LoginController@showLoginForm');
$router->post('/login', 'Auth\LoginController@login');

$router->get('/cart', 'CartsController@getCart');
$router->post('/cart', 'CartsController@addCart');
$router->post('/rm-cart', 'CartsController@removeCart');

$router->get('/order', 'OrdersController@getOrder');
$router->post('/order', 'OrdersController@addOrder');
$router->get('/order/{orderId}', 'OrdersController@findOrderById');
$router->post('/remove-order', 'OrdersController@removeOrder');


$router->get('/product/{prodId}', 'ProductsController@findProdById');
$router->post('/search', 'ProductsController@findByName');

$router->get('/', 'ProductsController@index');
$router->get('/home', 'ProductsController@index');
$router->get('/faq', 'FaqsController@index');
$router->get('/profile', 'ProfilesController@index');

$router->post('/add-prod', 'ProductsController@addProduct');
$router->post('/update-prod', 'ProductsController@updateProduct');
$router->post('/remove-product', 'ProductsController@removeProduct');
$router->get('/uploads/{photoId}', function($photoId) {
    echo 'uploads/' . $photoId;
});
$router->run();
