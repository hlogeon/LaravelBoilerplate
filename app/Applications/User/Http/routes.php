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

/**
 * @SWG\Swagger(
 *     basePath="/api/user",
 *     host="",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="User API",
 *         @SWG\Contact(name="Andrey Degtyaruk", email="hlogeon1@gmail.com")
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
$api->version('v1', function ($api) {
    /* @var \Dingo\Api\Routing\Router $api */
    $api->group(['prefix' => 'user'], function ($api) {
        $namespace = 'App\Applications\User\Http\Controllers\\';
        /* @var \Dingo\Api\Routing\Router $api */
        $api->get('/', ['as' => 'user.list', 'uses' => $namespace.'UserController@index']);
    });
});
