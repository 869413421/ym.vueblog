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
    [
        'namespace' => 'App\Http\Controllers\Api',
        'middleware' => 'bindings'
    ],
    function ($api)
    {
        $api->get('narbars', 'NarBarsController@index')->name('api.narBars.index');
        $api->get('topics', 'TopicController@index')->name('api.topic.index');

        $api->group([
            'middleware' => ['api.throttle'],
            'limit' => config('api.rate_limits.sign.limit'),
            'expires' => config('api.rate_limits.sign.expires'),
        ], function ($api)
        {
            //游客可访问接口
            $api->get('category', 'CategoryController@index')->name('api.Category.index');
            $api->get('verificationCode', 'VerificationCodeController@store')->name('api.verfiCode.store');
            $api->get('captchas', 'CaptchasController@store')->name('api.Captchas.store');
            $api->post('user', 'UserController@store')->name('api.User.store');
            $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
            $api->get('topic', 'TopicController@index')->name('api.topic.index');
            $api->get('topic/{topic}', 'TopicController@show')->name('api.topic.show');
            $api->get('topic/{topic}/comment', 'CommentController@index')->name('api.Comment.index');
            $api->get('user/{user}/topic', 'UserController@topic')->name('api.User.topic');
            //登陆后可以访问接口
            $api->group(['middleware' => 'api.auth'], function ($api)
            {
                $api->get('user', 'UserController@me')->name('api.User.show');
                $api->patch('user', 'UserController@update')->name('api.User.update');
                $api->get('user/action', 'UserController@action')->name('api.User.action');

                $api->post('image', 'ImageController@store')->name('api.Image.store');

                $api->post('topic', 'TopicController@store')->name('api.Topic.store');
                $api->patch('topic/{topic}', 'TopicController@update')->name('api.Topic.update');
                $api->delete('topic/{topic}', 'TopicController@destory')->name('api.Topic.delete');

                $api->get('topic/{topic}/good', 'GoodController@store')->name('api.Good.store');
                $api->delete('topic/{topic}/good', 'GoodController@destory')->name('api.Good.delete');

                $api->get('topic/{topic}/collection', 'CollectionController@store')->name('api.Collection.store');
                $api->delete('topic/{topic}/collection', 'CollectionController@destory')->name('api.Collection.delete');

                $api->post('topic/{topic}/comment', 'CommentController@store')->name('api.Comment.store');
                $api->post('topic/{topic}/comment/{comment}/reply', 'ReplyController@store')->name('api.reply.store');
            });
        });

    });