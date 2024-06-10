@extends('Clients.app')

@section('title', 'Tìm Kiếm Sản Phẩm')

@section('content')
<main>
    <!-- slide show  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slide1.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide2.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide5.webp" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- icon  -->
    <div class="component-icon">
        <div class="row icon">
            <div class="col" ng-repeat="icon in dsIcon">
                <a href="">
                    <img src="/" alt="">
                </a>
            </div>
        </div>
        <!-- icon sale  -->
        <div class="row icon-sale text-center">
            <div class="col">
                <a href="">
                    <img src="img/83k.webp" height="60px" alt="">
                </a>
            </div>
            <div class="col">
                <a href="">
                    <img src="img/138k.webp" height="60px" alt="">
                </a>
            </div>
            <div class="col">
                <a href="">
                    <img src="img/283k.webp" height="60px" alt="">
                </a>
            </div>
            <div class="col">
                <a href="">
                    <img src="img/338k.webp" height="60px" alt="">
                </a>
            </div>
        </div>
    </div>
    <!-- component flash deal  -->
    <div class="component-deal">
        <!-- sale  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/flashdeal.webp" height="40px" alt="">
                </a>
                <strong>
                    <a class="nav-link disabled nav justify-content-en d-none d-md-block" aria-current="page"
                        href="#">Xem Tất Cả Deal +</a>
                </strong>
            </div>
        </nav>
        <!-- product  -->
        <!-- slick slide  -->
        <div class="container">
            <h2>Từ khóa liên quan "{{ $query }}"</h2>
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                @foreach($product as $sp)
                <div class="col">
                    <div class="">
                        <a href="/detail/{{ $sp->id }}" style="text-decoration:none">
                            <div class="card">
                                <img src="img/{{$sp->img}}" class="card-img-top" alt="...">
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



    <div class="mt-3 container d-flex justify-content-center align-items-center">
        {{$product->appends(request()->query())->links('pagination::bootstrap-4')}}

    </div>
</main>
@endsection