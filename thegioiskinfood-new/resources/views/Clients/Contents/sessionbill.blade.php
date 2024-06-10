<!-- resources/views/Clients/Contents/show_temp_bill.blade.php -->
@extends('Clients.app')
@section('title', 'Hoàn Tất Đơn Hàng')
@section('content')
<div class="container">
    <div class="row m-5">
        <div class="col">
            <h4><img src="{{asset('img/success.jpg')}}" width="40px"> Đặt Hàng Thành Công</h4>
            <p>Mã Đơn Hàng: {{ $bill->id_bill }}</p>
            <p>Cảm ơn bạn đã đặt hàng!</p>
            <p>Sau khi nhận được thanh toán, chúng mình sẽ tự động chuẩn bị gửi hàng cho bạn nhé! Trong trường hợp
                phương
                thức thanh toán: Chuyển khoản nhưng bạn chưa chuyển khoản, hệ thống sẽ tự động hủy. Bạn vui lòng ấn vào
                nút
                "TƯ VẤN" ở bên dưới để được hỗ trợ thêm nhé. Cảm ơn bạn!</p>
            <strong>Thông tin đơn hàng</strong>

            <p>Thông tin giao hàng</p>
            <p>Tên Người Nhận: {{ $bill->name }}</p>
            <p>Email: {{ $bill->email }}</p>
            <p>Số Điện Thoại: {{ $bill->phone }}</p>

            <p>Địa Chỉ:{{ $bill->address }}</p>
            <p>Phương Thức Thanh Toán: {{ $bill->payment_methods }}</p>
            <h4 class="text-danger">Tổng Cộng: {{number_format($bill->totalfinal, 3, ',', '.') . ' đ';}}</h4>
        </div>

        <div class="border p-3 col">

            <div>
                @if ($bill->payment_methods === 'bank')
                <!-- Thông tin thanh toán qua ngân hàng -->
                <h4>Thông tin chuyển khoản ngân hàng</h4>
                <p>- Ngân Hàng CPTM VietComBank</p>
                <img src="{{asset('img/vcb.jpg')}}" width="200px">

                <p>- Số Tài Khoản: 1028329185</p>
                <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
                <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>

                @elseif ($bill->payment_methods === 'momo')
                <!-- Thông tin thanh toán qua ví MoMo -->
                <h4>Thông tin chuyển khoản qua MoMo</h4>

                <img src="{{asset('img/momo.jpg')}}" width="200px">

                <p>- Số Tài Khoản: 0832575905</p>
                <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
                <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
                @elseif ($bill->payment_methods === 'cash')
                <!-- Thông tin thanh toán qua ví MoMo -->
                <h4>Thanh Toán Khi Nhận Hàng</h4>


                <hr>
                <!-- Thêm các phương thức thanh toán khác tương tự ở đây -->
                @elseif ($bill->payment_methods === 'zalopay') {
                // Tạo thông tin chuyển khoản qua VNPay
                <h4>Thông tin chuyển khoản qua VNPay</h4>

                <img src=" {{asset('img/zlp.jpg')}}" width="200px">
                <p>- Số Tài Khoản: 0832575905</p>
                <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
                <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
                ";
                }@elseif ($bill->payment_methods === 'shoppee') {
                // Tạo thông tin chuyển khoản qua Shoppe Pay
                <h4>Thông tin chuyển khoản qua Shoppe Pay</h4>

                <img src="{{asset('img/spp.jpg')}}" width="200px">

                <p>- Số Tài Khoản: 0832575905</p>
                <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
                <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
                ";
                }
                @endif

                <!-- Display the product details -->
                <h4>Sản Phẩm</h4>
                <table class="table">

                    <tbody>
                        @foreach(json_decode(($bill->product)) as $product)

                        <tr>
                            <th scope="row"><img src="{{asset('img/'.$product->img)}}" width="30px"></th>
                            <td>{{ $product->name }} </td>
                            <td> {{ $product->quantity }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Complete order button -->

            </div>
        </div>
    </div>



    @endsection