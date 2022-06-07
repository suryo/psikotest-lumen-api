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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/posts', 'PostsController@index');

/**
 * route resource user
*/
// Route::apiResource('/user', App\Http\Controllers\Api\UserController::class);
$router->get('/userlogin', 'App\Http\Controllers\Api\UserController@getuserlogin');
// $router->get('/user', 'App\Http\Controllers\Api\UserController@update');


$router->group(['prefix' => 'api'], function () use ($router) {
    /*
    * Matches
    * /api/user (post, get method)
    * /api/userlogin (post, get method)
    * /api/user/id (get, put, delete method)
    */
    
    $router->get('user', 'UserController@index');
    $router->get('userlogin', 'UserController@getuserlogin');
    $router->get('user/{id}', 'UserController@show');
    $router->put('user/{id}', 'UserController@update');
    $router->delete('user/{id}', 'UserController@destroy');

    
    /*
    * Matches
    * /api/papi (post, get method)
    * /api/papi/id (get, put, delete method)
    */
    $router->post('papi', 'Api\PapiController@store');
    $router->get('papi', 'Api\PapiController@index');
    $router->get('papiuserresult', 'Api\PapiController@getPapiUserResult');
    $router->get('papi/{id}', 'Api\PapiController@show');
    $router->put('papi/{id}', 'Api\PapiController@update');
    $router->delete('papi/{id}', 'Api\PapiController@destroy');

     /*
    * Matches
    * /api/tiu (post, get method)
    * /api/tiu/id (get, put, delete method)
    */
    $router->post('tiu', 'Api\TiuController@store');
    $router->get('tiu', 'Api\TiuController@index');
    $router->get('tiu/{id}', 'Api\TiuController@show');
    $router->put('tiu/{id}', 'Api\TiuController@update');
    $router->delete('tiu/{id}', 'Api\TiuController@destroy');

     /*
    * Matches
    * /api/papi (post, get method)
    * /api/papi/id (get, put, delete method)
    */
    $router->post('riasec', 'Api\RiasecController@store');
    $router->get('riasec', 'Api\RiasecController@index');
    $router->get('riasec/{id}', 'Api\RiasecController@show');
    $router->put('riasec/{id}', 'Api\RiasecController@update');
    $router->delete('riasec/{id}', 'Api\RiasecController@destroy');
});

