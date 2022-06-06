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
    * /api/user/id (get, put, delete method)
    */
    // $router->post('user', 'App\Http\Controllers\Api\UserController@index');
    $router->get('user', 'api\UserController@index');
    $router->get('/userlogin', 'api\UserController@getuserlogin');
    $router->get('user/{id}', 'api\UserController@show');
    $router->put('user/{id}', 'api\UserController@update');
    $router->delete('user/{id}', 'api\UserController@destroy');

    
    /*
    * Matches
    * /api/papi (post, get method)
    * /api/papi/id (get, put, delete method)
    */
    $router->post('papi', 'api\PapiController@store');
    $router->get('papi', 'api\PapiController@index');
    $router->get('papiuserresult', 'api\PapiController@getPapiUserResult');
    $router->get('papi/{id}', 'api\PapiController@show');
    $router->put('papi/{id}', 'api\PapiController@update');
    $router->delete('papi/{id}', 'api\PapiController@destroy');

     /*
    * Matches
    * /api/tiu (post, get method)
    * /api/tiu/id (get, put, delete method)
    */
    $router->post('tiu', 'api\TiuController@store');
    $router->get('tiu', 'api\TiuController@index');
    $router->get('tiu/{id}', 'api\TiuController@show');
    $router->put('tiu/{id}', 'api\TiuController@update');
    $router->delete('tiu/{id}', 'api\TiuController@destroy');

     /*
    * Matches
    * /api/papi (post, get method)
    * /api/papi/id (get, put, delete method)
    */
    $router->post('riasec', 'api\RiasecController@store');
    $router->get('riasec', 'api\RiasecController@index');
    $router->get('riasec/{id}', 'api\RiasecController@show');
    $router->put('riasec/{id}', 'api\RiasecController@update');
    $router->delete('riasec/{id}', 'api\RiasecController@destroy');
});

