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
$router->get('/user', 'App\Http\Controllers\Api\UserController@update');


$router->group(['prefix' => 'api'], function () use ($router) {
    /*
    * Matches
    * /api/user (post, get method)
    * /api/user/id (get, put, delete method)
    */
    $router->post('user', 'Vis_userController@store');
    $router->get('user', 'api\UserController@index');
    $router->get('user/{id}', 'Vis_userController@show');
    $router->put('user/{id}', 'Vis_userController@update');
    $router->delete('user/{id}', 'Vis_userController@destroy');

    /*
    * Matches
    * /api/kota (post, get method)
    * /api/kota/id (get, put, delete method)
    */
    $router->post('kota', 'Vis_KotaController@store');
    $router->get('kota', 'Vis_KotaController@index');
    $router->get('kota/{id}', 'Vis_KotaController@show');
    $router->put('kota/{id}', 'Vis_KotaController@update');
    $router->delete('kota/{id}', 'Vis_KotaController@destroy');

    /*
    * Matches
    * /api/kecamatan (post, get method)
    * /api/kecamatan/id (get, put, delete method)
    */
    $router->post('kecamatan', 'Vis_KecamatanController@store');
    $router->get('kecamatan', 'Vis_KecamatanController@index');
    $router->get('kecamatan/{id}', 'Vis_KecamatanController@show');
    $router->put('kecamatan/{id}', 'Vis_KecamatanController@update');
    $router->delete('kecamatan/{id}', 'Vis_KecamatanController@destroy');

    /*
    * Matches
    * /api/kabupaten (post, get method)
    * /api/kabupaten/id (get, put, delete method)
    */
    $router->post('kabupaten', 'Vis_KabupatenController@store');
    $router->get('kabupaten', 'Vis_KabupatenController@index');
    $router->get('kabupaten/{id}', 'Vis_KabupatenController@show');
    $router->put('kabupaten/{id}', 'Vis_KabupatenController@update');
    $router->delete('kabupaten/{id}', 'Vis_KabupatenController@destroy');


    /*
    * Matches
    * /api/desa (post, get method)
    * /api/desa/id (get, put, delete method)
    */
    $router->post('desa', 'Vis_DesaController@store');
    $router->get('desa', 'Vis_DesaController@index');
    $router->get('desa/{id}', 'Vis_DesaController@show');
    $router->put('desa/{id}', 'Vis_DesaController@update');
    $router->delete('desa/{id}', 'Vis_DesaController@destroy');
});

