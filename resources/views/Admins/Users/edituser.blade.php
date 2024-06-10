@include('Admins/header')
@include('Admins/menu')
<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#index.php?page=home" class="nav-link">Trang Chủ</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Tìm Kiếm...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="{{asset('img/dz.jpg')}}">
        </a>
    </nav>
    @csrf
    <main class="my-5">
        <div class="container">
            <h3 class="text-center">Chỉnh Sửa Tài Khoản</h3>
            <form action="{{route('admin.edituser',$user->id)}}" method="POST" class=" mb-2" enctype="multipart/form-data">
                @csrf

                <div class="col form-group mb-3">
                    <label for="name">Tên Tài Khoản <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    <span class="err" id="nameErr"></span>
                </div>
                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                        <span class="err" id="nameErr"></span>
                    </div>
                    <div class="col form-group mb-3">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" {{$user->password}}>
                        <span class="err" id="nameErr"></span>
                    </div>
                </div>

                <div class=" col form-group mb-3">
                    <label for="img">Hình Ảnh <span class="text-danger">*</span></label>
                    <input type="file" name="img" id="img" class="form-control d-block" value="{{$user->img}}">
                    <input type="hidden" name="img" id="img" class="form-control d-block" value="{{$user->img}}">

                    <img src="{{ asset('img/' . $user->img) }}" width="80px">

                    <span class="err" id="imgErr"></span>
                </div>
                <div class="row">

                    <div class="col form-group mb-3">
                        <label for="address">Địa Chỉ<span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control d-block" value="{{$user->address}}">
                    </div>
                    <div class="col form-group mb-3">
                        <label for="phone">Số Điện Thoại<span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control d-block" value="{{$user->phone}}">
                    </div>
                </div>



                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="view">Trạng Thái</label>
                        <select class="form-control" name="status" id="status">
                            <option name="status" value="0" {{ $user->status == '0' ? 'selected' : '' }}>Đang Hoạt Động
                            </option>
                            <option class="text-danger" name="status" value="1" {{ $user->status == '1' ? 'selected' : '' }}><span class="text-danger"> Bị Khóa</span>
                            </option>

                        </select>
                        <span class="err" id="viewErr"></span>
                    </div>
                    <div class="col form-group mb-3">
                        <label for="view">Vai Trò</label>
                        <select class="form-control" name="role" id="role">
                            <option value="0" name="role">Khách Hàng</option>
                            <option value="1" name="role">Quản Trị</option>
                        </select>
                        <span class="err" id="viewErr"></span>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <input type="submit" value="Lưu" class="btn btn-dark px-5">
                </div>
            </form>
        </div>
    </main>


</section>