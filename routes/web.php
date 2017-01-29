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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group([
    'prefix' => 'api/v1'
], function ($app) {
    // User resource routes
    $app->get('users', 'UserController@index');
    $app->get('users/{id}', 'UserController@get');
    $app->post('users', 'UserController@create');
    $app->put('users/{id}', 'UserController@update');
    $app->delete('users/{id}', 'UserController@delete');

});