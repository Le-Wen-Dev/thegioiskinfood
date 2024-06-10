@extends('Clients.app')

@section('title', 'Đặt Hàng')

@section('content')
@php
$totalfinal = 0; // Khởi tạo biến tổng giá trị đơn hàng
$totaltemporary = 0; // Khởi tạo biến tổng giá tạm tính
@endphp
<div class="row mt-5 bill">
    <div class="col">

        <div class="card p-4">
            <div>
                <img src="img/logo.webp" width="100px" alt="">
            </div>
            <div>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="giohang.html" style="text-decoration: none;">Giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin giao hàng</li>
                    </ol>
                </nav>
                <p>Thông tin giao hàng</p>
            </div>
            <div>
                <form id="orderForm" action="/createbill" method="POST" class="row">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Họ Và Tên"
                            value="{{ $user->name }}">
                    </div>
                    <div class="mb-3 col-md-8">
                        <input type="email" class="form-control" name="email" placeholder="Email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                            value="{{ $user->phone }}">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="full_address" id="full_address"
                            placeholder=" Địa chỉ" value="{{ $user->address }}">
                    </div>

                    <p>Phương Thức Vận Chuyển</p>
                    <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);" class="p-3">
                        <div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="radio" id="maxspeed" name="ship" value="0"
                                        {{ old('ship') == '0' ? 'checked' : '' }}>
                                    <label for="maxspeed">
                                        [Chỉ Nhận Chuyển Khoản]Hỏa Tốc Nhận Trong 2-3H (HCM) <strong> 0.đ</strong>
                                    </label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="normal" name="ship" value="0"
                                        {{ old('ship') == '0' ? 'checked' : '' }}>
                                    <label for="normal">
                                        Giao Hàng Tiêu Chuẩn (HCM) - Nhận Trong 2 đến 3 ngày <strong> 0.đ</strong>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p>Phương Thức Thanh Toán</p>
                    <ul class="lisgroup">
                        <li class="list-group-item ">
                            <input type="radio" id="cash" name="payment_methods" value="cash"
                                {{ old('payment_methods') == 'cash' ? 'checked' : '' }}>
                            <label for="cash">
                                <img src="img/cash.svg" alt="">
                                Thanh toán tiền mặt khi nhận hàng (COD)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="bank" name="payment_methods" value="bank"
                                {{ old('payment_methods') == 'bank' ? 'checked' : '' }}>
                            <label for="bank">
                                <img src="img/bank.svg" alt="">
                                [Miễn phí thanh toán] Chuyển khoản qua ngân hàng (VietQR)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="momo" name="payment_methods" value="momo"
                                {{ old('payment_methods') == 'momo' ? 'checked' : '' }}>
                            <label for="momo">
                                <img src="img/momo1.svg" width="40px" alt="">
                                [Miễn phí thanh toán] Chuyển khoản qua ví MôMo
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="vnpay" name="payment_methods" value="zalopay"
                                {{ old('payment_methods') == 'vnpay' ? 'checked' : '' }}>
                            <label for="vnpay">
                                <img src="img/zalopay-logo.png" width="40px" alt="">
                                [Miễn phí thanh toán] Chuyển khoản qua ví ZaloPay
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="shoppee" name="payment_methods" value="shoppee"
                                {{ old('payment_methods') == 'shoppee' ? 'checked' : '' }}>
                            <label for="shoppee">
                                <img src="img/shoppe.webp" width="40px" alt="">
                                [Miễn phí thanh toán] Chuyển khoản qua ví Shoppee Pay
                            </label>
                        </li>
                    </ul>


            </div>
        </div>

    </div>
    <div class="col">
        <table class="table">
            @foreach($cart as $item)
            <tr>
                <td>
                    <img src="{{asset('img/'.$item->img)}}" width="70px" alt="">
                </td>
                <td>
                    {{$item->name_product}} <br>
                    <span class="text-danger">{{$item->quantity}}</span>
                </td>

                <td>{{number_format($item->total, 3, ',', '.') . ' đ';}}</td>
            </tr>
            <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $item->id }}">
            <input type="hidden" name="products[{{ $loop->index }}][name]" value="{{ $item->name_product }}">
            <input type="hidden" name="products[{{ $loop->index }}][img]" value="{{ $item->img }}">
            <input type="hidden" name="products[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}">
            <input type="hidden" name="products[{{ $loop->index }}][total]" value="{{ $item->total }}">

            @php
            // Tính tổng giá trị của từng sản phẩm và cộng dồn vào tổng giá trị đơn hàng
            $totaltemporary += $item->quantity * $item->price;
            $totalfinal += $item->quantity * $item->price;

            @endphp
            @endforeach
            <tr>
                <td colspan="2">
                    <input type="text" class="form-control" placeholder="MÃ GIẢM GIÁ">
                </td>
                <td>
                    <button class="btn btn-primary">SEARCH</button>
                </td>
            </tr>
            <tr>
                <td>Tạm Tính</td>
                <td></td>
                <td> {{number_format($totaltemporary, 3, ',', '.') . ' đ';}} </td>
            </tr>
            <tr>
                <td colspan="2">Phí Vận Chuyển</td>
                <td>0 đ</td>
            </tr>
            <tr>
                <td colspan="2">TỔNG CỘNG (đã bao gồm VAT)</td>
                <td style="color: red;">
                    <strong name="totalfinal">{{number_format($totalfinal, 3, ',', '.') . ' đ';}}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="mt-5">
                    <a href="/cartx" style="color:rgb(197, 21, 21);text-decoration: none">
                        <i class="fa-solid fa-backward"></i>
                        Giỏ hàng
                    </a>
                </td>
                <td>
                    <div class="mb-3">
                        <input type="hidden" name="totalfinal" value="{{ $totalfinal }}">
                        <button type="submit" class="btn btn-danger">Hoàn tất đơn hàng</button>
                    </div>
                </td>
            </tr>
        </table>

    </div>
    </form>
</div>

<script>
document.getElementById('orderForm').addEventListener('submit', function(e) {
    let isValid = true;
    let errorMessage = '';

    const name = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const phone = document.querySelector('input[name="phone"]').value;
    const fullAddress = document.querySelector('input[name="full_address"]').value;
    const ship = document.querySelector('input[name="ship"]:checked');
    const totalfinal = document.querySelector('input[name="totalfinal"]').value;
    const paymentMethods = document.querySelector('input[name="payment_methods"]:checked');

    if (name === '') {
        isValid = false;
        errorMessage += 'Họ và tên là bắt buộc.\n';
    }

    if (email === '') {
        isValid = false;
        errorMessage += 'Email là bắt buộc.\n';
    } else {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            errorMessage += 'Email không hợp lệ.\n';
        }
    }

    if (phone === '') {
        isValid = false;
        errorMessage += 'Số điện thoại là bắt buộc.\n';
    } else {
        const phonePattern = /^\d{10,15}$/;
        if (!phonePattern.test(phone)) {
            isValid = false;
            errorMessage += 'Số điện thoại phải có từ 10 đến 15 chữ số.\n';
        }
    }

    if (fullAddress === '') {
        isValid = false;
        errorMessage += 'Địa chỉ là bắt buộc.\n';
    }

    if (!ship) {
        isValid = false;
        errorMessage += 'Phương thức vận chuyển là bắt buộc.\n';
    }

    if (!paymentMethods) {
        isValid = false;
        errorMessage += 'Phương thức thanh toán là bắt buộc.\n';
    }

    if (!isValid) {
        e.preventDefault();
        alert(errorMessage);
    }
});
</script>
@endsection