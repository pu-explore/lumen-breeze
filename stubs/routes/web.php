<?php

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

/** @var Laravel\Lumen\Routing\Router $router */

//
//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});
//

$router->get('/', function () {
    return view('app');
});

$router->get('/welcome', function () use ($router) {
    return response()->json([
        'lumenVersion' => $router->app->version(),
        'phpVersion' => PHP_VERSION,
    ]);
});

$router->post('/login', ['uses' => 'AuthController@login']);

$router->post('/register', ['uses' => 'AuthController@register']);

$router->post('/forgot-password', ['uses' => 'AuthController@forgotPassword']);

$router->get('#/reset-password', ['as' => 'password.reset']);// Used for address links in emails
$router->post('/reset-password', ['uses' => 'AuthController@resetPassword']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/dashboard', ['uses' => 'HomeController@dashboard']);
});

