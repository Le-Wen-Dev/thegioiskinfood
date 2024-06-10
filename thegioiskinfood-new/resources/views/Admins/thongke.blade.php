@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')




<!-- CONTENT -->
<section id="content">

    <!-- NAVBAR -->
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
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Thống Kê</h1>
            </div>
        </div>

        <div class="admin_statistical">
            <ul class="nav_statistical">
                <li><a href="index.php?page=arrange">Doanh Thu</a></li>
                <li><a href="index.php?page=view_product">Sản Phẩm Nhiều Lượt Xem</a></li>
                <li class="active"><a href="index.php?page=buy_product">Sản Phẩm Nhiều Lượt Mua</a></li>
            </ul>

            <div class="content_statistical px-5">
                <table class="table my-5">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Sản Phẩm</th>
                            <th>Danh Mục</th>
                            <th>Đã Bán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="{{asset('uploads/ct1.jpg')}}" width="50px" /></td>
                            <td>Chân Váy</td>
                            <td>Váy</td>
                            <td>70.000.000 đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>