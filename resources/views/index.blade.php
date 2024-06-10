@extends('Clients.app')

@section('title', 'Trang Chủ')

@section('content')

<main>

    <!-- slide show  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
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

            </div>
        </nav>
        <!-- product  -->
        <!-- slick slide  -->
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                @foreach($productSale as $sp)
                <div class="col">
                    <form action="/pdhearth" method="post" id="form_{{$sp->id}}">
                        <div class="">

                            <div class="card">
                                <a href="/detail/{{ $sp->id }}" style="text-decoration:none">
                                    <img src="img/{{$sp->img}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">{{ str($sp->name)->limit(30, '...') }}</p>
                                    <del class="card-text">{{number_format($sp->price, 3, ',', '.') . ' VND';}}</del>

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
                                    <span>{{$sp->view}} </span>
                                    @php
                                    $user = Session::get('user');
                                    if($user) {
                                    $heart = \App\Models\Hearths::where('user_id', $user->id)->where('product_id',
                                    $sp->id)->first();
                                    } else {
                                    $heart = null;
                                    }
                                    @endphp
                                    @if(isset($user) && $user->id)
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @else
                                    <input type="hidden" name="user_id" value="">
                                    @endif

                                    <input type="hidden" name="product_id" value="{{$sp->id}}">
                                    <input type="hidden" name="img" value="{{$sp->img}}">
                                    <input type="hidden" name="name" value="{{$sp->name}}">
                                    <input type="hidden" name="price" value="{{$sp->price}}">
                                    @csrf
                                    @if($heart)
                                    <button type="submit" class="btn btn-light bg-danger">
                                        <i class="fa-regular fa-heart "></i>


                                    </button>
                                    <!-- Biểu tượng yêu thích đã được thêm -->
                                    @else
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa-regular fa-heart"></i>

                                    </button>
                                    <!-- Biểu tượng yêu thích chưa được thêm -->
                                    @endif




                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Khám Phá  -->
    <div class="component-deal">
        <!-- sale  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <h3>KHÁM PHÁ</h3>

            </div>
        </nav>
        <!-- product  -->
        <!-- slick slide  -->
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                @foreach($productBest as $best)
                <div class="col">
                    <form action="/pdhearth" method="post" id="form_{{$best->id}}">
                        <div class="">

                            <div class="card">
                                <a href="/detail/{{ $best->id }}" style="text-decoration:none">
                                    <img src="img/{{$best->img}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">{{ str($sp->name)->limit(30, '...') }}</p>
                                    <del class="card-text">{{number_format($best->price, 3, ',', '.') . ' VND';}}</del>
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
                                    <span>{{$best->view}} </span>
                                    @php
                                    $user = Session::get('user');
                                    if($user) {
                                    $heart = \App\Models\Hearths::where('user_id', $user->id)->where('product_id',
                                    $sp->id)->first();
                                    } else {
                                    $heart = null;
                                    }
                                    @endphp
                                    @if(isset($user) && $user->id)
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @else
                                    <input type="hidden" name="user_id" value="">
                                    @endif

                                    <input type="hidden" name="product_id" value="{{$sp->id}}">
                                    <input type="hidden" name="img" value="{{$sp->img}}">
                                    <input type="hidden" name="name" value="{{$sp->name}}">
                                    <input type="hidden" name="price" value="{{$sp->price}}">
                                    @csrf
                                    @if($heart)
                                    <button type="submit" class="btn btn-light bg-danger">
                                        <i class="fa-regular fa-heart "></i>


                                    </button>
                                    <!-- Biểu tượng yêu thích đã được thêm -->
                                    @else
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa-regular fa-heart"></i>

                                    </button>
                                    <!-- Biểu tượng yêu thích chưa được thêm -->
                                    @endif



                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- clearance sale  -->
    <div class="component-claerancesal">
        <!-- sale  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <h3>CLEARANCE </h3>

            </div>
        </nav>
        <!-- product  -->
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                @foreach($productBythuonghieu as $sp)
                <div class="col">
                    <form action="/pdhearth" method="post" id="form_{{$sp->id}}">
                        <div class="">

                            <div class="card">
                                <a href="/detail/{{ $sp->id }}" style="text-decoration:none">
                                    <img src="img/{{$sp->img}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">
                                    <p class="card-text">{{ str($sp->name)->limit(30, '...') }}</p>
                                    </p>
                                    <del class="card-text">{{number_format($sp->price, 3, ',', '.') . ' VND';}}</del>

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
                                    <span>{{$sp->view}} </span>
                                    @php
                                    $user = Session::get('user');
                                    if($user) {
                                    $heart = \App\Models\Hearths::where('user_id', $user->id)->where('product_id',
                                    $sp->id)->first();
                                    } else {
                                    $heart = null;
                                    }
                                    @endphp
                                    @if(isset($user) && $user->id)
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @else
                                    <input type="hidden" name="user_id" value="">
                                    @endif
                                    <input type="hidden" name="product_id" value="{{$sp->id}}">
                                    <input type="hidden" name="img" value="{{$sp->img}}">
                                    <input type="hidden" name="name" value="{{$sp->name}}">
                                    <input type="hidden" name="price" value="{{$sp->price}}">
                                    @csrf
                                    @if($heart)
                                    <button type="submit" class="btn btn-light bg-danger">
                                        <i class="fa-regular fa-heart "></i>


                                    </button>
                                    <!-- Biểu tượng yêu thích đã được thêm -->
                                    @else
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa-regular fa-heart"></i>

                                    </button>
                                    <!-- Biểu tượng yêu thích chưa được thêm -->
                                    @endif


                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Trang điểm  -->
    <div class="component-claerancesal">
        <!-- sale  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <h3>TRANG ĐIỂM</h3>

            </div>
        </nav>
        <!-- product  -->
        <div class="container">

            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                @foreach($productBycategory as $sp)
                <div class="col">
                    <form action="/pdhearth" method="post" id="form_{{$sp->id}}">
                        <div class="">

                            <div class="card">
                                <a href="/detail/{{ $sp->id }}" style="text-decoration:none">
                                    <img src="img/{{$sp->img}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">{{ str($sp->name)->limit(30, '...') }}</p>



                                    <del class="card-text">{{number_format($sp->price, 3, ',', '.') . ' VND';}}</del>

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
                                    <span>{{$sp->view}} </span>
                                    @php
                                    $user = Session::get('user');
                                    if($user) {
                                    $heart = \App\Models\Hearths::where('user_id', $user->id)->where('product_id',
                                    $sp->id)->first();
                                    } else {
                                    $heart = null;
                                    }
                                    @endphp
                                    @if(isset($user) && $user->id)
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @else
                                    <input type="hidden" name="user_id" value="">
                                    @endif

                                    <input type="hidden" name="product_id" value="{{$sp->id}}">
                                    <input type="hidden" name="img" value="{{$sp->img}}">
                                    <input type="hidden" name="name" value="{{$sp->name}}">
                                    <input type="hidden" name="price" value="{{$sp->price}}">
                                    @csrf
                                    @if($heart)
                                    <button type="submit" class="btn btn-light bg-danger">
                                        <i class="fa-regular fa-heart "></i>


                                    </button>
                                    <!-- Biểu tượng yêu thích đã được thêm -->
                                    @else
                                    <button type="submit" class="btn btn-light">
                                        <i class="fa-regular fa-heart"></i>

                                    </button>
                                    <!-- Biểu tượng yêu thích chưa được thêm -->
                                    @endif



                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-3 container d-flex justify-content-center align-items-center">
        {{$pagina->links('pagination::bootstrap-4')}}
    </div>

</main>
<script>
    // Add click event listener to all elements with class 'pdhearth'
    document.querySelectorAll('.pdhearth').forEach(item => {
        // Get the corresponding form ID from the data attribute
        const formId = item.getAttribute('data-form-id');
        // Add click event listener
        item.addEventListener('click', function() {
            // Submit the form with corresponding ID
            document.getElementById('form_' + formId).submit();
        });
    });
</script>
@endsection