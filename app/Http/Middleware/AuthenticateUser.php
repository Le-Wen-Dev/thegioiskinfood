<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        // Lấy token từ session
        $token = Session::get('token');

        // Kiểm tra xem token có tồn tại và hợp lệ hay không
        if (!$token || !JWTAuth::setToken($token)->check()) {
            return redirect()->route('formlogin')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        return $next($request);
    }
}
