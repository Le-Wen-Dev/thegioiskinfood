@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="/admin" class="nav-link">Trang Chủ</a>
        <form action="{{route('admin.searchcate')}}" method="GET">
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
            <h3 class="text-center">Quản Lý Danh Mục</h3>
            <h4>Từ Khóa Liên Quan: <span class="textdanger">{{$query}}</span></h4>
            <a href="/admin/storecategories">Thêm danh mục mới</a>
            <table class="table table-show-category show-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Hình Ảnh</th>
                        <th>Số Sản Phẩm</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Nhập</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>
                            {{ str($item->name)->limit(20, '...') }}
                        </td>
                        <td><img src="{{ asset('img/' . $item->image) }}" alt="anhdanhmuc" width="50px"></td>
                        <td>
                            {{ $item->products_count }}
                        </td>
                        <td>
                            <form action="{{ route('admin.changeStatusCate', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    @if($item->status == 0)
                                    <span class="text-dark" style="text-decoration:none">Đang Bán</span>
                                    @elseif($item->status==1) <p>Ngưng Bán</p>
                                    @endif
                                </button>
                            </form>

                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                        <td>
                            <a href="/admin/editcategory/{{$item->id}}"><i class="bx bx-edit"></i></a>
                            <a href="/admin/removecategory/{{$item->id}}"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="mt-3 container d-flex justify-content-center align-items-center">
            {{$categories->links('pagination::bootstrap-4')}}
        </div>

</section>
<!-- CONTENT -->