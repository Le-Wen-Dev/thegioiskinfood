@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
@php
$productData = json_decode($bill->product, true);
@endphp

<div class="mt-4 mb-4 d-flex justify-content-center">
    <ul class="list-group card " style="width:30rem">
        <li class="list-group-item">
            <div class="row">
                <div class="col">
                    <img src="{{asset('img/logo.webp')}}" height="70px" alt="">
                    <p>Mã Đơn Hàng: <strong>{{$bill->id_bill}}</strong></p>
                </div>
                <div class="col">
                    <p>Mã Vận Đơn: <strong>{{$bill->mavandon}}</strong></p>
                    <p>Đơn Vị Vận Chuyển: <strong>{{$bill->shipping_units}}</strong></p>

                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col"><strong>Từ:</strong>
                    <p>Tên Người Gửi: Mai Lê Quel</p>
                    <p>SDT Người Gửi: 0832575905</p>
                    <p>Dịa Chỉ: 195 Tô Ngọc Vân, Phường Thạnh Xuân, Quận 12, HCM</p>
                </div>
                <div class="col"><strong>Đến:</strong>

                    <p>Tên khách hàng: {{ $bill->name }}</p>
                    <p>Email: {{ $bill->email }}</p>
                    <p>Số Điện Thoại: {{ $bill->phone }}</p>
                    <p>Địa chỉ: {{ $bill->address }}</p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <table class="table table-show-category show-table table-bordered">
                <thead>
                    <tr>
                        <th>Tên Sản Phấm</th>
                        <th>Số Lượng</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($productData as $product)
                    <tr>
                        <td>
                            {{ $product['name'] }}
                        </td>
                        <td>
                            {{ $product['quantity'] }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">
                    <p>Tiền Thu Người Nhận:</p>
                    @if($bill->payment_methods == 'cash')
                    <h4 class="text-danger">{{ number_format($bill->totalfinal, 3, ',', '.') . ' đ' }}</h4>
                    @else
                    <h4 class="text-danger">Đã thanh toán </h4>
                    @endif
                    <p>Chỉ Dẫn Giao Hàng:</p>
                    <ul>
                        <li>Không Đồng Kiểm</li>
                        <li>Chuyển Hoàn Sau 3 Lần Phát</li>
                        <li>Lưu Kho Tối Đa 5 Ngày</li>
                    </ul>
                </div>
                <div class="col">
                    <p>Khối Lượng Tối Đa: 1250g</p>
                    <p>Phương Thức Thanh Toán: {{$bill->payment_methods}}</p>
                    <p>Mọi Thắc Mắc Liên Hệ Shop SDT/Zalo: 0832575905 </p>


                </div>
            </div>
        </li>

    </ul>
</div>

x

@section('styles')
<link rel=" stylesheet" href="{{ asset('css/showbill.css') }}">
@endsection