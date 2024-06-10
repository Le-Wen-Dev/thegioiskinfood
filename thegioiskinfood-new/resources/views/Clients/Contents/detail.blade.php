@extends('Clients.app')

@section('title', 'Chi tiết')

@section('content')
<div class="container">
    <main>

        <div class="main mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('img/' . $detail->img) }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-footer">
                            @if($detail->gallery)
                            @foreach(json_decode($detail->gallery) as $image)
                            <img src="{{ asset('img/' . $image) }}" width="90px" alt="Gallery Image">
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div>
                        <p>MERZY</p>
                        <p>
                            <input type="hidden" value="{{$detail->id}}">
                            <strong>{{$detail->name}}</strong>
                        </p>
                        <i style="font-size:10px" class="fa-solid fa-star"></i>
                        <i style="font-size:10px" class="fa-solid fa-star"></i>
                        <i style="font-size:10px" class="fa-solid fa-star"></i>
                        <i style="font-size:10px" class="fa-solid fa-star"></i>
                        <i style="font-size:10px" class="fa-solid fa-star"></i>
                        <span>1 đánh giá</span>
                        |
                        <span>Chưa có hỏi đáp</span>
                        |
                        <span>{{$detail->view}} đã xem</span>
                        <i class="fa-regular fa-heart "></i>
                        <button type="button" class="btn btn-primary p-1" style="font-size: 8px;">Free ship
                            HCM</button>
                        <button type="button" class="btn btn-danger p-1" style="font-size: 8px;">New</button>
                    </div>
                    <div class="mt-4 p-3 bg-light">
                        <p>
                            <del>{{number_format($detail->price, 3, ',', '.') . ' VND';}}</del>
                        </p>
                        <h5 style="color:rgb(185, 41, 41)">
                            <strong>{{number_format($detail->price, 3, ',', '.') . ' VND';}}</strong>
                        </h5>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <img src="{{asset('img/sonduong4.webp')}}" width="30px" alt="">
                                        <span>LB01</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <hr>
                    <form action="/addtocart" method="POST">
                        <div class="quantity flex">
                            <p>Chọn Số Lượng</p>
                            <div class="btn-quantity flex  mb-2">
                                <button id="decrement" class="btn bg-light">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                                <button id="increment" class="btn bg-light">+</button>
                            </div>

                            <script>
                            var decrementButton = document.getElementById("decrement");
                            var incrementButton = document.getElementById("increment");
                            var quantityInput = document.getElementById("quantity");

                            decrementButton.addEventListener("click", function(e) {
                                e.preventDefault();
                                var currentQuantity = parseInt(quantityInput.value);
                                if (currentQuantity > 1) {
                                    quantityInput.value = currentQuantity - 1;
                                }
                            });

                            incrementButton.addEventListener("click", function(e) {
                                e.preventDefault();
                                var currentQuantity = parseInt(quantityInput.value);
                                quantityInput.value = currentQuantity + 1;
                            });
                            </script>
                        </div>
                        <div>



                            @csrf
                            @if(Session::has('user'))
                            @php
                            $user = Session::get('user');
                            @endphp
                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                            @endif
                            <input type="hidden" name="id" value="{{ $detail->id }}">
                            <input type="hidden" name="name" value="{{ $detail->name }}">
                            <input type="hidden" name="img" value="{{ $detail->img }}">
                            <input type="hidden" name="price" value="{{ $detail->price }}">
                            <button type="submit" class="btn bg-danger">
                                <i class="fa-solid fa-cart-shopping" style="color:white"></i>
                                Thêm Vào Giỏ Hàng
                            </button>
                    </form>


                </div>
                <div class="mt-4 p-3 bg-light">
                    <img src="{{asset('img/momo.webp')}}" width="40px" alt="">
                    <img src="{{asset('img/vnpay.webp')}}" width="40px" alt="">
                    <img src="{{asset('img/shoppe.webp')}}" width="40px" alt="">
                </div>
            </div>
        </div>

</div>

<!-- de xuat  -->
<div class="main">
    <div class="row">
        <div class="col-md-9">
            <div class="mb-5">
                <img src="{{asset('img/merzy.webp')}}" width="50px" alt="" class="border circle">
                <span>MERZY</span>
            </div>
            <div>
                <h5>Chi Tiết Sản Phẩm</h5>
                <p>Son Dưỡng Ẩm Có Màu Cho Môi Mềm Mịn, Căng Mọng Merzy Siren Melting Color Lip Balm là son thỏi
                    dưỡng có màu nằm trong bộ sưu tập Merzy Siren Collection lấy cảm hứng từ vẻ đẹp quyến rũ
                    kiêu sa của mỹ nhân ngư. Có chất son mềm mịn như "tan chảy" trên môi, giúp dưỡng ẩm trong
                    nhiều giờ liền với các tone màu MLBB nhẹ nhàng tươi tắn, dễ dàng sử dụng hằng ngày.</p>
                <img src="{{asset('img/detail.webp')}}" height="400px" width="450px" alt="">
                <p>
                    <strong>***Thế giới Skinfood là đại lý phân phối chính thức thương hiệu Merzy tại Việt
                        Nam.</strong>
                </p>
                <img src="{{asset('img/ctificate.webp')}}" height="400px" width="450px" alt="">
                <p>
                    <strong>• Đặc trưng:</strong>
                    <br>
                    <strong>- Son Dưỡng Ẩm Có Màu Cho Môi Mềm Mịn, Căng Mọng Merzy Siren Melting Color Lip
                        Balm</strong>
                    hiện đã có tại Thế giới Skinfood. Có tone màu MLBB nhẹ nhàng, tươi trẻ cho đôi môi căng mọng
                    nước và rạng rỡ phù hợp sử dụng hằng ngày.
                    <br>
                    - Thiết kế hình trụ thon dài, cầm chắc tay, có màu chủ đạo cây son chính là hồng pastel.
                    Điểm nhấn là chữ Merzy đa sắc màu dưới ánh nắng.
                    <br>
                    - Có thành phần lành tính môi có độ dưỡng ẩm cao, giàu dưỡng chất giúp bảo vệ môi và dưỡng
                    ẩm hiệu quả.
                    <br>
                    - Kết cấu son mềm mịn như "tan chảy" tăng khả năng dưỡng ẩm cho môi nhiều giờ liền.
                    <br>
                    - Chất son bám chặt, khóa ẩm trên môi, giúp đôi môi căng mọng chỉ với một lần thoa.
                    <br>
                    - Son có độ bóng đa dạng tạo độ đàn hồi, căng mọng trong suốt thời gian dài.
                    <br>
                    - Son Dưỡng Ẩm Có Màu Cho Môi Mềm Mịn, Căng Mọng Merzy Siren Melting Color Lip Balm có các
                    màu MLBB sau:
                    <br>
                    LB1 Baby Rose: Hồng sữa đào
                    <br>
                    LB2 Red Bell: Đỏ cam MLBB
                    <br>
                    LB3 Cherry Canvas: Hồng mận ánh nâu
                    <br>
                    LB4 Love Fig: Cam nâu trà
                    <br>
                    *** Lưu ý bảo quản: Tránh để sản phẩm tiếp xúc trực tiếp với ánh sáng, những nơi có nhiệt độ
                    quá thấp, hoặc nhiệt độ quá cao.
                </p>
            </div>
        </div>
        <div class="col">
            @foreach($productSale as $sp)
            <div class="col">
                <div class="">
                    <a href="/detail/{{ $sp->id }}" style="text-decoration:none">
                        <div class="card">
                            <img src="{{ asset('img/' . $sp->img) }}" class="card-img-top" alt="...">

                            <div class="card-body">
                                <p class="card-text">{{$sp->name}}</p>
                                <del class="card-text">{{number_format($sp->price, 3, ',', '.') . ' VND';}}</del>
                                <span class="product-sale border rounded-circle  p-10">{{$sp->sold }} %</span>
                                <br>
                                <span class="card-text" style="color:rgb(174, 11, 11);">
                                    <strong>{{number_format($sp->price, 3, ',', '.') . ' VND';}}</strong>
                                </span>
                                <br>
                                <i style="font-size:10px" class="fa-solid fa-star"></i>
                                <i style="font-size:10px" class="fa-solid fa-star"></i>
                                <i style="font-size:10px" class="fa-solid fa-star"></i>
                                <i style="font-size:10px" class="fa-solid fa-star"></i>
                                <i style="font-size:10px" class="fa-solid fa-star"></i>
                                <span>{{$sp->view}} K</span>
                                <i class="fa-regular fa-heart "></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</main>
</div>
@endsection