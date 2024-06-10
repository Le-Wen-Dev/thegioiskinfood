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
            <h3 class="text-center">Thêm Danh Mục</h3>
            <form action="{{route('admin.storecategories')}}" method="POST" class=" mb-2" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="category_id">Danh Mục Cha</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($categories as $category)
                            @if (!in_array($category->name, ['Sale', 'Bán Chạy', 'New']))
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @foreach ($category->childrenCategories as $childCategory)
                            <option value="{{ $childCategory->id }}">&nbsp;&nbsp; {{ $childCategory->name }}</option>
                            @foreach ($childCategory->subCategories as $subcat)
                            <option value="{{ $subcat->id }}">&emsp;&emsp;{{ $subcat->name }}</option>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach
                        </select>
                        <span class="err" id="viewErr"></span>
                    </div>
                    <div class=" col form-group mb-3">
                        <label for="name">Tên Danh Mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control">
                        <span class="err" id="categoryErr"></span>
                    </div>
                </div>
                <div class="row">
                    <div class=" col form-group mb-3">
                        <label for="img">Hình Ảnh <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control d-block">

                        <span class="err" id="imgErr"></span>
                    </div>

                </div>
                <div class="form-group mb-3">
                    <label for="info"> Mô Tả <span class="text-danger">*</span></label>
                    <textarea type="text" name="description" id="info" class="form-control"></textarea>
                    <span class="err" id="infoErr"></span>
                </div>

                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="view">Trạng Thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0" name="status">Đang Bán</option>
                            <option value="1" name="status">Ngưng Bán</option>
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