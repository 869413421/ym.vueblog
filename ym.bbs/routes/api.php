<?php

use function foo\func;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',
    ['namespace' => 'App\Http\Controllers\Api'],
    function ($api) {
        $api->get('narbars', 'NarBarsController@index')->name('api.narBars.index');
        $api->get('topics', 'TopicController@index')->name('api.topic.index');

        $api->group([
            'middleware' => 'api.throttle',
            'limit' => config('api.rate_limits.sign.limit'),
            'expires' => config('api.rate_limits.sign.expires'),
        ], function ($api) {
            //游客可访问接口
            $api->get('verificationCode', 'VerificationCodeController@store')->name('api.verfiCode.store');
            $api->get('captchas', 'CaptchasController@store')->name('api.Captchas.store');
            $api->post('user', 'UserController@store')->name('api.User.store');
            $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
            $api->get('post', 'PostController@index')->name('api.Post.show');
            //登陆后可以访问接口
            $api->group(['middleware' => 'api.auth'], function ($api) {
                $api->get('user', 'UserController@me')->name('api.User.show');
                $api->patch('user', 'UserController@update')->name('api.User.update');
                $api->post('image', 'ImageController@store')->name('api.Image.store');

                $api->post('post', 'PostController@store')->name('api.Post.store');
                $api->post('post', 'PostController@update')->name('api.Post.update');
            });
        });

    });