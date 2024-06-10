<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/clients.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/" class="navbar-brand">
                <img src="{{asset('img/banner-top.webp')}}" class="img-fluid" alt="">
            </a>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('img/logo.webp')}}" height="70px" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                        <a class="nav-link navbar-nav me-auto mb-2 mb-lg-0" href="#">
                            <li class="nav-item">

                                <div class="col-md-6 d-flex " style="width: 400px;">

                                    <div class="form">
                                        <form action="{{ route('search') }}" method="GET">
                                            <i class="fa fa-search"></i>
                                            <input type="text" class="form-control form-input" name="query">

                                        </form>

                                    </div>

                                </div>

                            </li>
                        </a>
                        <div class="d-flex btn ">Hotline: 1900 636 510</a>
                            <div class="ml-3 icon-user">
                                @if(Session::has('user'))
                                @php
                                $user = Session::get('user');
                                @endphp
                                <div class="dropdown">
                                    <img src="{{ asset('img/' . $user->img) }}" width="30px" style="border-radius:50%"
                                        onmouseover="showSubMenu()" onmouseout="hideSubMenu()">
                                    <ul class="sub-menu-user" id="sub-menu-user">
                                        <li class="text-decoration">Xin chào, <span
                                                class="text-danger">{{ $user->name }}</span></li>
                                        <li class=""><a href="/inforuser">Thông Tin Cá Nhân</a></li>
                                        <li class=""><a href="/followorder">Đơn Hàng</a></li>
                                        <li class=""><a href="/changepass">Đổi Mật Khẩu</a></li>
                                        @if($user->role == 1)
                                        <li class=""><a href="/admin">Kênh Admin</a></li>
                                        @endif
                                        <li class=""><a class="btn btn-danger p-2 text-white" href="/logout">Đăng
                                                Xuất</a></li>
                                    </ul>
                                </div>
                                @else
                                <a href="/formlogin" style="text-decoration: none;color:black" class="d-flex btn">
                                    <i class="far fa-user"></i>
                                </a>
                                @endif
                            </div>
                            <a href="/productshearth" class="d-flex btn position-relative">
                                <i class="far fa-heart"></i>
                                @if(session()->has('user'))
                                @php
                                $heartCount = \App\Models\Hearths::where('user_id', session('user')->id)->count();
                                @endphp
                                @if($heartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $heartCount }}
                                    <span class="visually-hidden">sản phẩm</span>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @endif
                                @endif
                            </a>
                            <a href="/cart" class="d-flex btn position-relative">
                                <i class="fas fa-shopping-bag"></i>
                                @if(session()->has('user'))
                                @php
                                $cartCount = \App\Models\Carts::where('id_user', session('user')->id)->count();
                                @endphp
                                @if($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                    <span class="visually-hidden">sản phẩm</span>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @endif
                                @endif
                            </a>

                        </div>
                    </div>
            </nav>
            <!-- menu 2 -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/index">
                        <i class="fa-solid fa-bars"></i>
                        <strong>Home</strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            @foreach ($categories as $category)
                            @if (in_array($category->name, ['Sale', 'Bán Chạy', 'New']))
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="categories/{{$category->id}}">
                                    <strong>{{ $category->name }}</strong>
                                </a>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle menub1" href="categories/{{$category->id}}"
                                    id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <strong>{{ $category->name }}</strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-grid" aria-labelledby="navbarDropdownMenuLink">
                                    <div class="row menutreo">
                                        <div class="col">
                                            @foreach ($category->childrenCategories as $childCategory)
                                            <strong class="">
                                                <a class="dropdown-item element-menu"
                                                    href="{{ route('categories', $childCategory->id) }}">{{ $childCategory->name }}</a></strong>
                                            <ul>
                                                @foreach ($childCategory->subCategories as $subcat)
                                                <a class="dropdown-item element-menu"
                                                    href="{{ route('categories', $subcat->id) }}">{{ $subcat->name }}</a>
                                                @endforeach
                                            </ul>
                                            @endforeach


                                        </div>
                                    </div>
                                </ul>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <script>
                    document.getElementById("navbarDropdownMenuLink").addEventListener("click", function(event) {
                        event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>
                        var href = this.getAttribute("href"); // Lấy đường dẫn từ thuộc tính href
                        window.location.href = href; // Chuyển hướng đến đường dẫn
                    });
                    </script>
                </div>
            </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/angular.min.js"></script>
    <script src="assets/js/angular-route.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>