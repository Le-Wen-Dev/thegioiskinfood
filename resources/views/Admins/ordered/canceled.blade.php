@extends('Clients.app')

@section('title', 'Theo Dõi Đơn Hàng')

@section('content')
<div class="row m-4">
    <div class="col-md-3">
        <div class="row">
            <div class="col m-1"> <img src="{{asset('img/'.$user->img)}}" class="rounded-circle" width="60px"></div>
            <div class="col-md-8">
                <p class="m-1">{{$user->name}}</p>
                <p class="m-1">{{$user->email}}</p>
            </div>

        </div>
        <hr>
        <div class="inforuser">
            <p> <i class="fa-regular fa-user"></i><a href="/inforuser"> Thông Tin</a> </p>
            <p><i class="fa-solid fa-bag-shopping"></i> <a href="/followorder"> Quản Lý Đơn Hàng</a></p>
            <p><i class="fa-solid fa-key"></i> <a href="/changepass"> Đổi Mật Khẩu</a></p>
            @if($user->role == 1)
            <p><i class="fa-solid fa-bars-progress"></i><a href="/admin"> Kênh Admin</a></p>
            @endif

            <p><i class="fa-solid fa-right-from-bracket"></i> <a href="/logout"> Đăng Xuất</a></p>
        </div>
    </div>
    <div class="col-md-9">
        <p><strong>THEO DÕI ĐƠN HÀNG</strong></p>
        @include("Clients/Contents/ordered.statusmenu")
        <section class="load">

        </section>

    </div>
</div>
@endsection