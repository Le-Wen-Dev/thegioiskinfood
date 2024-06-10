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
            <table class="table table-show-category show-table">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Sản Phẩm</th>

                        <th>TỔNG TIỀN</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bill as $bill)
                    @php
                    $productData = json_decode($bill->product, true);
                    $productDetails = '';
                    foreach ($productData as $product) {
                    $productDetails .= '<div>';
                        $productDetails .= $product['name'] . '<br>';
                        $productDetails .= '<img src="' . asset('img/' . $product['img']) . '" width="30px"><br>';
                        $productDetails .= $product['quantity'] . '<br>';
                        $productDetails .=number_format($product['total'], 3, ',', '.') . '
                        đ<br>';
                        $productDetails .= '</div>
                    <hr>';
                    }
                    @endphp
                    <tr>
                        <td>{{ $bill->id_bill }}</td>
                        <td colspan="3">{!! $productDetails !!}</td>
                        <td class="text-danger"> <strong>{{number_format($bill->totalfinal,3,',','.').'đ'}}</strong>
                            <form action="{{ route('cancelorder', $bill->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="status" value="{{$bill->status}}">
                                <button type="submit" class="btn btn-danger mt-5">
                                    Hủy
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </section>

    </div>
</div>
@endsection