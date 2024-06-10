@extends('Clients.app')

@section('title', 'Đăng Nhập')

@section('content')

<div class="main mt-3">
    <div class="card p-5 text-center m-3 m-auto" style="width:25rem">
        <form class=" row" action="/login" method="POST">
            @csrf
            <div class="mb-3 ">
                <strong class="form-label">Email</strong>
                <input type="email" class="form-control" name="email" placeholder="Vd: user@gmail.com">
                @error('email')
                <span id="emailError" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 ">
                <strong class="form-label">Mật Khẩu</strong>
                <input type="password" class="form-control" name="password">
                @error('password')
                <span id="passwordError" class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Đăng Nhập</button>
            <button type="button" class="btn btn-success mb-3">
                <a href="/formregis" style="color:white">Đăng Ký</a>
            </button>
            <!-- <button type="button" class="btn btn-primary mb-3  col-md-12">
                <i style="color:white" class="fa-brands fa-facebook"></i>
                Đăng nhập bằng Facebook
            </button>
            <button type="button" class="btn btn-danger col-md-12 mb-3">
                <i style="color:white" class="fa-brands fa-google"></i>
                Đăng Nhập bằng Google
            </button> -->
            <button type="button" class="btn btn-light col-md-12 mb-3">
                <a href="#!quenmatkhau" style="color:black" text-decoration="none">
                    ?
                    Quên Mật Khẩu
                </a>
            </button>
        </form>
    </div>
</div>


@endsection