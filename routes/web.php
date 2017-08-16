<?php

use Illuminate\Contracts\Routing\Registrar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->group(['middleware' => 'guest', 'namespace' => 'Auth', 'prefix' => '/auth'], function (Registrar $router) {
    $router->get('/sign-in', [
        'as' => 'get::auth.sign-in',
        'uses' => 'AuthenticationController@show',
    ]);

    $router->post('/sign-in', [
        'as' => 'post::auth.sign-in',
        'uses' => 'AuthenticationController@attempt',
    ]);

    $router->get('/sign-up', [
        'as' => 'get::auth.sign-up',
        'uses' => 'RegistrationController@show',
    ]);

    $router->post('/sign-up', [
        'as' => 'post::auth.sign-up',
        'uses' => 'RegistrationController@attempt',
    ]);

    $router->get('/forgot', [
        'as' => 'get::auth.forgot',
        'uses' => 'ForgotController@show',
    ]);

    $router->post('/forgot', [
        'as' => 'post::auth.forgot',
        'uses' => 'ForgotController@send',
    ]);

    $router->get('/reset/{token}', [
        'as' => 'get::auth.reset',
        'uses' => 'ResetController@show',
    ]);

    $router->post('/reset/{token}', [
        'as' => 'post::auth.reset',
        'uses' => 'ResetController@attempt',
    ]);
});

$router->get('/auth/sign-out', [
    'as' => 'get::auth.sign-out',
    'uses' => 'Auth\AuthenticationController@redact',
]);

$router->group(['namespace' => 'Common'], function (Registrar $router) {
    $router->get('/', [
        'as' => 'get::common.home',
        'uses' => 'ViewController@home',
    ]);

    $router->group(['namespace' => 'Game', 'prefix' => '/game'], function (Registrar $router) {
        $router->get('/servers', [
            'as' => 'get::common.game.servers',
            'uses' => 'ViewController@servers',
        ]);

        $router->get('/features', [
            'as' => 'get::common.game.features',
            'uses' => 'ViewController@features',
        ]);

        $router->get('/download', [
            'as' => 'get::common.game.download',
            'uses' => 'ViewController@download',
        ]);

        $router->get('/screenshots', [
            'as' => 'get::common.game.screenshots',
            'uses' => 'ViewController@screenshots',
        ]);

        $router->get('/statistics', [
            'as' => 'get::common.game.statistics',
            'uses' => 'StatisticController@show',
        ]);
    });
});

$router->group(['middleware' => 'auth', 'namespace' => 'Personal', 'prefix' => '/personal'], function (Registrar $router) {
    $router->get('/account', [
        'as' => 'get::personal.account',
        'uses' => 'AccountController@show',
    ]);

    $router->post('/account', [
        'as' => 'post::personal.account',
        'uses' => 'AccountController@update',
    ]);

    $router->get('/account/password', [
        'as' => 'get::personal.account.password',
        'uses' => 'PasswordController@show',
    ]);

    $router->post('/account/password', [
        'as' => 'post::personal.account.password',
        'uses' => 'PasswordController@update',
    ]);
});
