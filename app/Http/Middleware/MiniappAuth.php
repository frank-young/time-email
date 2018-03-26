<?php

namespace App\Http\Middleware;
use Closure;
use Exception;
use App\Models\WxUser;

class MiniappAuth
{
    public function handle($request, Closure $next)
    {
        try {
            // 如果用户登陆后的所有请求没有jwt的token抛出异常
            if (!empty($request->header('token'))) {
              $token = $request->header('token');
              $wxuser = WxUser::find($token);
              $request->merge(['wxuser_id' => $wxuser->id]);
            } else {
              $res = [
                'errcode' => 1002,
                'success' => false,
                'msg' => '您没有权限访问'
              ];
              return response()->json($res);
            }
        } catch (Exception $e) {
            $res = [
              'errcode' => 1002,
              'success' => false,
              'msg' => '您没有权限访问'
            ];
            return response()->json($res);
        }
        return $next($request);
    }
}
