<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //检测用户是否登录
        if (!session('admin_id')) {
            return redirect(route('admin.login'));
        }

        $request->offsetSet('admin_id', session('admin_id'));

        return $next($request);
    }
}
