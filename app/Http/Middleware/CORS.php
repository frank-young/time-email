<?php

namespace App\Http\Middleware;
use Closure;
class CORS
{
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin' => 'http://tm.nanafly.com',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE, PATCH',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Auth-Token, Origin, application/json, token',
            'Access-Control-Allow-Credentials' => 'true'
        ];
        // if($request->getMethod() == "OPTIONS") {
        //     return Response::make('OK', 200, $headers);
        // }
        $response = $next($request);
        foreach ($headers as $key => $value) {
          $response->header($key, $value);
        }
        return $response;
    }
}
