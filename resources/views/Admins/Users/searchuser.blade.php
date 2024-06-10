@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
<!-- CONTENT -->
<section id="content">

    <nav>
        <i class='bx bx-menu'></i>
        <a href="/admin" class="nav-link">Trang Chủ</a>
        <form action="{{route('admin.searchuser')}}" method="GET">
            <div class="form-input">
                <input type="search" placeholder="Tìm Kiếm..." name="query">
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
    <main>
        <div class="container">
            <h3 class="text-center">Quản Lý Tài Khoản</h3>
            <h5 class="mb-4">Từ khóa liên quan: {{$query}}</h5>
            <a href="/admin/formstoreuser">Thêm sản tài khoản mới</a>
            <table class="table table-show-category show-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Vai Trò</th>
                        <th>Trạng Thái</th>



                        <th>Thao Tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($user as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>
                            {{ str($item->name)->limit(15, '...') }}
                        </td>
                        <td><img src="{{ asset('img/' . $item->img) }}" alt="" width="30px"></td>
                        <td>
                            {{$item->address}}
                        </td>
                        <td>
                            {{$item->phone}}
                        </td>
                        <td>
                            @if($item->role == 1)
                            Quản Trị
                            @else
                            Khách Hàng
                            @endif
                        </td>
                        <td>
                            @if($item->status ==0)
                            Bình Thường
                            @else
                            <span class="text-danger">Bị Khóa</span>
                            @endif
                        </td>

                        <td>
                            <a href="/admin/edituser/{{$item->id}}"><i class="bx bx-edit"></i></a>
                            <a href="/admin/deleteuser/{{$item->id}}"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-3 container d-flex justify-content-center align-items-center">
            {{$user->links('pagination::bootstrap-4')}}
        </div>

</section>
<!-- CONTENT -->