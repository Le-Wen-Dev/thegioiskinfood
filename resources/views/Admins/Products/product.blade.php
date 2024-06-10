@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="/admin" class="nav-link">Trang Chủ</a>
        <form action="{{route('admin.searchproduct')}}" method="GET">
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
            <h3 class="text-center">Quản Lý Sản Phẩm</h3>
            <a href="/admin/product/addproduct">Thêm sản phẩm mới</a>
            <table class="table table-show-category show-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Giá</th>
                        <th>Kho</th>
                        <th>Ngày Nhập</th>

                        <th>Thao Tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>
                            {{ str($item->name)->limit(20, '...') }}
                        </td>
                        <td><img src="{{ asset('img/' . $item->img) }}" alt="" width="50px"></td>
                        <td>
                            {{number_format($item->price, 3, ',', '.') . ' đ';}}
                        </td>
                        <td>
                            {{$item->warehouse}}
                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                        <td>
                            <a href="/admin/product/edit/{{$item->id}}"><i class="bx bx-edit"></i></a>
                            <a href="/admin/product/delete/{{$item->id}}"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-3 container d-flex justify-content-center align-items-center">
            {{$products->links('pagination::bootstrap-4')}}
        </div>

</section>
<!-- CONTENT -->