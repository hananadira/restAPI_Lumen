<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// stuff (penulisan -> /path, NamaController@namaFunction)
/* Hal umum yang bisa menyebabkan error yaitu urutan antara dynamic routes dan static routes yang tumpang:
    static routes berada di atas sebelum dynamic routes 
    dynamic routes berada di bawah setelah static routes */

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/profile', 'AuthController@me');




// STUFF
    // static routes
    $router->get('stuff/data', 'StuffController@index');
    $router->post('stuff/post', 'StuffController@store');
    $router->get('stuff/trash', 'StuffController@trash');
    
    // dynamic routes
    $router->get('stuff/show/{id}', 'StuffController@show');
    $router->patch('stuff/update/{id}', 'StuffController@update');
    $router->delete('stuff/delete/{id}', 'StuffController@destroy');
    $router->get('stuff/restore/{id}', 'StuffController@restore');
    $router->delete('stuff/permanent/{id}', 'StuffController@permanent');

    // inbound 
    $router->get('inbound-stuffs/data', 'InboundStuffController@index');
    $router->post('inbound-stuffs/store', 'InboundStuffController@store');
    $router->get('inbound-stuffs/trash', 'InboundStuffController@trash');

    $router->delete('inbound-stuffs/delete/{id}', 'InboundStuffController@destroy');
    $router->get('inbound-stuffs/restore/{id}', 'InboundStuffController@restore');
    $router->delete('inbound-stuffs/permanent-delete/{id}', 'InboundStuffController@permanentDelete');


// User
    // static routes
    $router->get('user/data', 'UserController@index');
    $router->post('user/post', 'UserController@store');
    $router->get('user/trash', 'UserController@trash');

    // dynamic routes
    $router->get('user/show/{id}', 'UserController@show');
    $router->patch('user/update/{id}', 'UserController@update');
    $router->delete('user/delete/{id}', 'UserController@destroy');