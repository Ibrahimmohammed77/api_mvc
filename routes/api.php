<?php
// routes/api.php
use App\Core\Router;

// إنشاء كائن الراوتر
$router = new Router();

// مسارات المصادقة عبر API
$router->post('api/login', 'AuthApiController@login');
$router->post('api/logout', 'AuthApiController@logout');

// Products CRUD (JWT Protected)
$router->get('api/products', 'ProductApiController@index');
$router->get('api/products/{id}', 'ProductApiController@show');
$router->post('api/products', 'ProductApiController@store');
$router->put('api/products/{id}', 'ProductApiController@update');
$router->delete('api/products/{id}', 'ProductApiController@destroy');
return $router;
