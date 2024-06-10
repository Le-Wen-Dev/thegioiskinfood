@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="/category" class="nav-link">Danh Mục Sản Phẩm</a>
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
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Danh Mục Sản Phẩm</h1>
            </div>
        </div>
        <div class="admin-category">
            <p class="err">
                <?php
                if (isset($_SESSION["message"]) && $_SESSION["message"] != "") {
                    echo $_SESSION["message"];
                    unset($_SESSION["message"]);
                }
                ?>
            </p>
            <a href="">Thêm Danh Mục Mới</a>

            <table class="table table-show-category">
                <thead>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Danh Mục</th>
                    <th>Tùy Chọn</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="{{asset('uploads/ct1.jpg')}}" width="50px"></td>
                        <td>Chân Váy</td>
                        <td>Hiển Thị Trang Chủ</td>
                        <td>Đang kinh doanh</td>
                        <td>
                            <a href="/"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>

                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="{{asset('uploads/ct4.jpg')}}" width="50px"></td>
                        <td>Chân Váy</td>
                        <td>Hiển Thị Trang Chủ</td>
                        <td>Đang kinh doanh</td>
                        <td>
                            <a href="/"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>

                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="{{asset('uploads/ct3.jpg')}}" width="50px"></td>
                        <td>Chân Váy</td>
                        <td>Hiển Thị Trang Chủ</td>
                        <td>Ngừng kinh doanh</td>
                        <td>
                            <a href="/"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>

                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><img src="{{asset('uploads/ct2.jpg')}}" width="50px"></td>
                        <td>Chân Váy</td>
                        <td>Hiển Thị Trang Chủ</td>
                        <td>Đang kinh doanh</td>
                        <td>
                            <a href="/"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->