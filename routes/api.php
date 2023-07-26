<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'api/user'], function () use ($router) {
    $router->post('/register', 'UserController@register');
    $router->post('/sign-in', 'AuthController@signIn');
    $router->post('/recover-password', 'AuthController@recoverPassword');
    $router->post('/reset-password', 'AuthController@resetPassword');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/companies', 'UserCompaniesController@list');
        $router->post('/companies', 'UserCompaniesController@create');
    });
});
