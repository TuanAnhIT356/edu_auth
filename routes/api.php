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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post(
    'login',
    'AuthController@login'
);

$router->group(
    ['middleware' => 'api.auth'],
    function() use ($router) {
        $router->post('get-list-user', 'UsersController@getListUser');

        $router->post('get-list-role', 'RoleController@getListRole');

        $router->post('edit-role', 'RoleController@getListRole');

        $router->post('update-status-role', 'RoleController@updateStatus');
    }
);
