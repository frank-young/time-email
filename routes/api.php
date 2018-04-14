<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array',
], function ($api) {
    // 获取 token
    // $api->post('authorizations', 'AuthorizationController@store')
    //     ->name('api.authorizations.store');
    // // 刷新 token
    // $api->put('authorizations/current', 'AuthorizationController@update')
    //     ->name('api.authorizations.update');
    // // 注销token
    // $api->delete('authorizations/current', 'AuthorizationController@destroy')
    //     ->name('api.authorizations.destroy');


    // 小程序接口部分
    $api->group([
      'middleware' => 'miniapp.auth'
    ], function ($api) {
        // 添加邮件
        $api->post('letter/store', 'LetterController@store');
        // 我的邮件
        $api->get('letter/user/list', 'LetterController@userLetterList');
    });
    $api->group([], function ($api) {
        // 微信登录
        $api->post('auth/loginByWeixin','WxUserController@login');
        // 已到达公开邮件
        $api->get('letter/list', 'LetterController@publicList');
        $api->get('letter/show', 'LetterController@show');
        $api->get('letter/arrived', 'LetterController@letterArrived');
    });
});
