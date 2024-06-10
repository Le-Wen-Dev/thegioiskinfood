@extends('Clients.app')

@section('title', 'Giỏ Hàng')

@section('content')
@php
$totalfinal = 0; // Khởi tạo biến tổng giá trị đơn hàng
@endphp
<div class="mt-3 main giohang">
    <div class="row">
        <div class="col-md-8">
            <h1 class="">Giỏ Hàng</h1>
            <p style="color:rgb(121, 18, 18)">
                Yah! Bạn đã được Freeship
                <strong> FREESHIP TOÀN QUỐC</strong>
            </p>
            <div class="progress" style=" height:8px; margin:5px">
                <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" style="width: 100%;"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="text-center">Vui Lòng Qua Bước Thanh Toán Để Nhận Quà!</p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sản Phẩm</th>
                            <th scope="col"></th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Đơn Giá</th>
                            <th scope="col">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('img/' . $item->img) }}" width="70px" alt="">
                            </td>
                            <td>
                                <a href="/detail/{{$item->id}}" style="text-decoration: none;color:black">
                                    <p>
                                        {{$item->name_product}}
                                    </p>
                                    <p>
                                        <form action="/removecart" method="POST">
                                            @csrf
                                            @if(Session::has('user'))
                                            @php
                                            $user = Session::get('user');
                                            @endphp
                                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <!-- Thêm hidden input cho id_product -->
                                            <button type="submit" class="btn bg-light increase-quantity"> <i
                                                    class="fa-solid fa-x"></i>
                                                Xóa</button>
                                            <!-- Thêm type="submit" -->
                                        </form>

                                    </p>
                                </a>
                            </td>
                            <td>
                                <div class="mb-2">
                                    <form action="/decreasecart" method="POST">
                                        @csrf

                                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn bg-light decrease-quantity mb-1">--</button>
                                    </form>

                                    <button class="btn bg-light quantity mb-1">{{ $item->quantity }}</button>
                                    <form action="/increasecart" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <!-- Thêm hidden input cho id_product -->
                                        <button type="submit" class="btn bg-light increase-quantity">+</button>
                                        <!-- Thêm type="submit" -->
                                    </form>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <del>{{number_format($item->price, 3, ',', '.') . ' đ';}}</del>
                                <p class="text-danger">{{number_format($item->price, 3, ',', '.') . 'đ';}}
                                </p>
                            </td>
                            <td>
                                <p class="text-danger">
                                    {{number_format( $item->total, 3, ',', '.') . ' đ';}}

                                </p>
                            </td>
                        </tr>
                        @php
                        // Tính tổng giá trị của từng sản phẩm và cộng dồn vào tổng giá trị đơn hàng
                        $totalfinal += $item->quantity * $item->price;
                        @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <form action="/removeallcart" method="POST">
                    @csrf
                    @if(Session::has('user'))
                    @php
                    $user = Session::get('user');
                    @endphp
                    @endif
                    <input type="hidden" name="id_user" value="{{ $user->id }}">
                    <button type="submit" class="btn btn-danger">
                        Xoá Giỏ Hàng</button>
                </form>
            </div>

        </div>


        <div class="col-md-4 mt-5">
            <div class="card p-3">
                <table class="table">
                    <h5>TỔNG ĐƠN HÀNG</h5>
                    <tr>
                        <td>Tạm tính</td>
                        <td>{{number_format($totalfinal, 3, ',', '.') . ' đ';}}</td>
                    </tr>
                    <tr>
                        <td>Giảm Giá</td>
                        <td ng-repeat="item in cart">0 đ</td>
                    </tr>
                    <tr>
                        <td>Tổng</td>
                        <td class="text-danger"><strong>{{number_format($totalfinal, 3, ',', '.') . ' đ';}}</strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="mt-3">
                <a href="/" style="color:black;text-decoration: none">
                    <i class="fa-solid fa-backward"></i>
                    Tiếp tục mua sắm
                </a>
                <button class="btn bg-primary text-white  m-3">
                    <input type="hidden" name="totalfinal" value="{{$totalfinal}}">
                    <a href="/bill" style="color:white;text-decoration: none">
                        Tiếp Tục Thanh toán
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection