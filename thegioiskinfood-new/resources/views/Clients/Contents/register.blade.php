@extends('Clients.app')

@section('title', 'Đăng Ký')

@section('content')
<div class="main mt-3">
    <div class="card p-5   m-auto " style="width:50rem">
        <div class=" ">
            <h3 class="mb-5 ">
                Đăng Ký Tài Khoản
            </h3>
        </div>
        <div class="">
            <form class=" row" action="/register" method="POST" id="registerForm">
                @csrf
                <div class="mb-3 col-md-6">
                    <strong class="form-label">Tên Đăng Nhập</strong>
                    <input type="text" class="form-control" name="name" id="name">

                </div>
                <div class="mb-3 col-md-6">
                    <strong class="form-label">Email</strong>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Vd: user@gmail.com">

                </div>
                <div class="mb-3 col-md-6">
                    <strong class="form-label">Số Điện Thoại</strong>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Vd: 0832575905">

                </div>

                <div class="mb-3 ">
                    <strong class="form-label">Mật Khẩu</strong>
                    <input type="password" class="form-control" name="password" id="password">

                </div>
                <div class="mb-3 ">
                    <strong class="form-label">Xác Nhận Mật Khẩu</strong>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">

                </div>
                <button class="btn btn-primary" type="button" onclick="validateForm()">Đăng Ký</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var password = document.getElementById('password').value;
        var password_confirmation = document.getElementById('password_confirmation').value;

        var errors = [];

        if (name.trim() === '') {
            errors.push("Vui lòng nhập tên đăng nhập");
        }

        if (email.trim() === '') {
            errors.push("Vui lòng nhập địa chỉ email");
        } else if (!validateEmail(email)) {
            errors.push("Địa chỉ email không hợp lệ");
        }

        if (phone.trim() === '') {
            errors.push("Vui lòng nhập số điện thoại");
        }

        if (password.trim() === '') {
            errors.push("Vui lòng nhập mật khẩu");
        }

        if (password_confirmation.trim() === '') {
            errors.push("Vui lòng xác nhận mật khẩu");
        }

        if (password !== password_confirmation) {
            errors.push("Mật khẩu và xác nhận mật khẩu không khớp");
        }

        if (errors.length > 0) {
            var errorMessage = "Đã có lỗi xảy ra:\n";
            errors.forEach(function(error) {
                errorMessage += "- " + error + "\n";
            });
            alert(errorMessage);
        } else {
            document.getElementById('registerForm').submit();
        }
    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>
@endsection