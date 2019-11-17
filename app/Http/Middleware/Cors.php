<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin','http://127.0.0.1:8000')//本番環境では設定を変更。
            ->header('Access-Control-Allow-Methods','GET,POST,PUT,DELETE,OPTIONS')
            ->header('Access-Control-Allow-Headers','Content-Type');
            
    }
}
