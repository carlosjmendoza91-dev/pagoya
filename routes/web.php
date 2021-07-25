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

$router->group(['middleware' => 'auth','prefix' => 'transaction'], function ($router)
{
    $router->post('/', 'TransactionController@store');
});

$router->group(['middleware' => 'auth','prefix' => 'user'], function ($router)
{
    $router->post('logout', 'AuthController@logout');
});

$router->group(['prefix' => 'user'], function () use ($router)
{
    $router->post('signup', 'AuthController@signup');
    $router->post('login', 'AuthController@login');
});



