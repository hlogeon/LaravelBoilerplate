<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    /** @var \Dingo\Api\Routing\Router $api */
    $api->group(['prefix' => 'user'], function($api) {
        $namespace = 'App\Applications\User\Http\Controllers\\';
        /** @var \Dingo\Api\Routing\Router $api */
        $api->get('/', ['as' => 'user.list', 'uses' => $namespace . 'UserController@index']);
    });
});

