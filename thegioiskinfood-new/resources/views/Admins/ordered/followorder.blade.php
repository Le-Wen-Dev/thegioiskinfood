@extends('Admins.app')

@section('title', 'Theo Dõi Đơn Hàng')

@section('content')
<div class="row m-4">
    <div class="col-md-3">

    </div>
    <div class="col-md-9">
        <p><strong>THEO DÕI ĐƠN HÀNG</strong></p>
        @include("Admins/ordered.statusmenu")
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
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection