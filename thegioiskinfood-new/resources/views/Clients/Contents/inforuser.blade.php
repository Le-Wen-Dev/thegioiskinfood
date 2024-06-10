@extends('Clients.app')

@section('title', 'Thông Tin Cá Nhân')

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
        <p><strong>THÔNG TIN TÀI KHOẢN</strong></p>
        <form action="/updateuser" method="POST" class=" mb-2" enctype="multipart/form-data">
            @csrf

            <div class=" form-group mb-3">
                <label for="name">Họ Và Tên </label>
                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class=" form-group mb-3">
                <label for="name">Email </label>
                <input type="text" name="email" id="name" class="form-control" value="{{$user->email}}">
                <span class="err" id="nameErr"></span>
            </div>
            <div class="row">
                <div class=" form-group mb-3">
                    <label for="img">Hình Ảnh </label>
                    <input type="file" name="img" id="img" class="form-control d-block" value="{{$user->img}}">
                    <img src="{{asset('img/'.$user->img)}}" width="50px">
                    <span class="err" id="imgErr"></span>
                </div>

            </div>
            <div class="form-group mb-3">
                <label for="address">Địa Chỉ </label>
                <input type="text" name="addresss" id="address" class="form-control" value="{{$user->address}}"></>
                <span class="err" id="infoErr"></span>
            </div>
            <div class="form-group mb-3">
                <label for="phone">Số Điện Thoại </label>
                <input type="text" name="phone" id="address" class="form-control" value="{{$user->phone}}"></>

            </div>
            @if($user->role == 1)
            <div class="form-group mb-3">
                <label for="role">Vai Trò </label>
                <select class="form-control" name="role" id="id">
                    <option value="0" {{$user->role == 0 ? 'selected' : ''}}>User</option>
                    <option value="1" {{$user->role == 1 ? 'selected' : ''}}>Admin</option>
                </select>
            </div>
            @endif

            <div class="form-group mb-3">
                <input type="submit" value="Lưu" class="btn btn-dark px-5">
            </div>
        </form>
    </div>
</div>
@endsection