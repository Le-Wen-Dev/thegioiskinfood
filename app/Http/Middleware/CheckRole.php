<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;


class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        // Lấy thông tin người dùng từ session
        $user = Session::get('user');

        // Kiểm tra xem người dùng có tồn tại và có vai trò là admin hay không
        if ($user && $user->role == 1) {
            // Nếu người dùng có vai trò là admin, cho phép truy cập vào các route admin
            return $next($request);
        }

        // Nếu người dùng không có vai trò là admin, chuyển hướng hoặc trả về lỗi
        // Ví dụ: Chuyển hướng về trang chủ
        return redirect()->route('admin.index')->with('error', 'Bạn không có quyền truy cập vào trang này');
    }
}
