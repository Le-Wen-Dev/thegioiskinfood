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

            <h3 class="text-center">Cập Nhật Sản Phẩm</h3>
            <form action="{{ route('edit',$product->id) }}" method="POST" class=" mb-2" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class=" col form-group mb-3">
                        <label for="id_category">Tên Danh Mục <span class="text-danger">*</span></label>

                        <select class="form-control" name="categories_id" id="categories_id">
                            <option value="1">Chọn Danh Mục</option>
                            @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach

                        </select>
                        <span class="err" id="categoryErr"></span>
                    </div>
                    <div class=" col form-group mb-3">
                        <label for="id_category">Tên Thương Hiệu <span class="text-danger">*</span></label>

                        <select class="form-control" name="brands_id" id="id_category">
                            <option value="0">Chọn Thương Hiệu</option>
                            @foreach($brands as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach

                        </select>
                        <span class="err" id="categoryErr"></span>
                    </div>


                </div>
                <div class="col form-group mb-3">
                    <label for="name">Tên Sản Phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control">
                    <span class="err" id="nameErr"></span>
                </div>
                <div class="row">
                    <div class=" col form-group mb-3">
                        <label for="img">Hình Ảnh <span class="text-danger">*</span></label>
                        <input type="file" name="img" id="img" class="form-control d-block">
                        <img src="{{ asset('img/' . $product->img) }}" width="80px">
                        <span class="err" id="imgErr"></span>
                    </div>
                    <div class="col form-group mb-3">
                        <label for="gallery">Bộ sưu tập <span class="text-danger">*</span></label>
                        <input type="file" name="gallery[]" id="gallery" class="form-control d-block" multiple>
                        @foreach(json_decode($product->gallery) as $image)
                        <img src="{{ asset('img/' . $image) }}" width="90px" alt="Gallery Image">
                        @endforeach
                        <span class="err" id="galleryErr"></span>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <label for="info"> Mô Tả <span class="text-danger">*</span></label>
                    <textarea type="text" name="description" id="info" class="form-control"
                        value="{{$product->description}}"></textarea>
                    <span class="err" id="infoErr"></span>
                </div>
                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="price">Giá (VND) <span class="text-danger">*</span> </label>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="price" id="price" value="{{$product->price}}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">VND</span>
                        </div>
                        <span class="err" id="priceErr"></span>
                    </div>

                    <div class="col form-group mb-3">
                        <label for="sold">Giảm Giá (%) <span class="text-danger">* </span></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="sold" id="sold" value="{{$product->sold}}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                        <span class="err" id="saleErr"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col form-group mb-3">
                        <label for="view">Trạng Thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0" name="status">Ngưng Bán</option>
                            <option value="1" name="status">Đang Bán</option>
                        </select>
                        <span class="err" id="viewErr"></span>
                    </div>
                    <div class="col form-group mb-3">
                        <label for="quantiy">Số Lượng</label>
                        <input type="text" name="quantity" id="quantity" value="{{$product->quantity}}"
                            class="form-control">
                        <span class="err" id="sizeErr"></span>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <input type="submit" value="Thêm Sản Phẩm Mới" class="btn btn-dark px-5">
                </div>
            </form>

        </div>
    </main>


</section>