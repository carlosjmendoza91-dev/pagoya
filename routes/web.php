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

$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router)
{
    $router->post('transaction', 'TransactionController@store');
    $router->post('logout', 'AuthController@logout');
});

$router->group(['prefix' => 'api'], function () use ($router)
{
    $router->post('signup', 'AuthController@signup');
    $router->post('login', 'AuthController@login');
});



