@extends('Clients.app')

@section('title', 'Danh Mục Sản Phẩm')

@section('content')
<main class="container">

    <div class="row">
        <div class="col-md-3">
            <p>Danh Mục</p>
            <h2>CHĂM SÓC DA</h2>
            <hr>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            TỪ KHÓA
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            @foreach ($loadallcate as $category)
                            <div class="row menutreo">
                                <div class="col">

                                    @foreach ($category->childrenCategories as $childCategory)
                                    <a class="dropdown-item element-menu"
                                        href="{{route('categories',$childCategory->id)}}"><input
                                            type="checkbox">{{ $childCategory->name }}
                                    </a>

                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <!-- <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('img/bannercategory.webp')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/slide2.webp')}}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/slide5.webp')}}" class="d-block w-100" alt="...">
                    </div>
                </div> -->
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
            <!-- <div class="component-icon">

            
                <div class="row icon-sale text-center">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Phổ Biến</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Bán Chạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Mới Nhất</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Giá Thấp</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Giá Cao</a>
                        </li>

                    </ul>
                </div>
            </div> -->

            <!-- Khám Phá  -->
            <div class="component-deal">
                <!-- sale  -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <h3>
                            {{ request()->is('categories/*') ? $categoryNameDynamic->name : 'CHĂM SÓC DA' }}
                        </h3>


                    </div>
                </nav>
                <!-- product  -->
                <!-- slick slide  -->
                <div class="container">
                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                        @foreach($productBest as $best)
                        <div class="col" style="width: 16rem;">
                            <div class="">
                                <a href="/detail/{{ $best->id }}" style="text-decoration:none">
                                    <div class="card">
                                        <img src="{{ asset('img/' . $best->img) }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">{{$best->name}}</p>
                                            <del
                                                class="card-text">{{number_format($best->price, 3, ',', '.') . ' VND';}}</del>
                                            <span class="product-sale border rounded-circle  p-10">{{$best->sold }}
                                                %</span>
                                            <br>
                                            <span class="card-text" style="color:rgb(174, 11, 11);">
                                                <strong>{{number_format($best->price, 3, ',', '.') . ' VND';}}</strong>
                                            </span>
                                            <br>
                                            <i style="font-size:10px" class="fa-solid fa-star"></i>
                                            <i style="font-size:10px" class="fa-solid fa-star"></i>
                                            <i style="font-size:10px" class="fa-solid fa-star"></i>
                                            <i style="font-size:10px" class="fa-solid fa-star"></i>
                                            <i style="font-size:10px" class="fa-solid fa-star"></i>
                                            <span>{{$best->view}} K</span>
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
            <!-- clearance sale  -->

            <div class="mt-3 container d-flex justify-content-center align-items-center">
                {{$pagina->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
    <!-- slide show  -->

</main>
@endsection