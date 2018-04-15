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
        $api->post('comment/store', 'CommentController@store');

        // 信件点赞
        $api->post('letter/like/increment', 'LikeController@incrementLikeCount');
        $api->post('letter/like/decrement', 'LikeController@decrementLikeCount');

        // 我的邮件
        $api->get('letter/user/list', 'LetterController@userLetterList');

        // 公开邮件详情
        $api->get('letter/show', 'LetterController@show');
    });
    $api->group([], function ($api) {
        // 微信登录
        $api->post('auth/loginByWeixin','WxUserController@login');
        // 已到达公开邮件
        $api->get('letter/list', 'LetterController@publicList');

        // 到达操作
        $api->get('letter/arrived', 'LetterController@letterArrived');

        // 获取评论
        $api->get('comment/list', 'CommentController@list');
        $api->get('comment/increment', 'CommentController@incrementLikeCount');
        $api->get('comment/decrement', 'CommentController@decrementLikeCount');

    });
});
