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
                <h1>Danh Sách Mã Giảm Giá</h1>
            </div>
        </div>
        <div class="voucher-container">
            <p class="err">
                <?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                } ?>
            </p>
            <table class="table">
                <a href="index.php?page=add_voucher">Thêm mã giảm giá mới</a>

                <thead>
                    <th>ID</th>
                    <th>Mã Voucher</th>
                    <th>Giảm</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày Kết thúc</th>
                    <th>Thao Tác</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>J97</td>
                        <td>10 %</td>
                        <td>20/10/2023</td>
                        <td>20/12/2023</td>
                        <td>
                            <a href="index.php?page=update_voucher&id=' . $vc['id'] . '" class="btn-edit"><i class="bx bx-edit"></i></a>
                            <a href="index.php?page=delete_voucher&id=' . $vc['id'] . '" class="btn-delete"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>jack97</td>
                        <td>40 %</td>
                        <td>20/12/2023</td>
                        <td>20/1/2024</td>
                        <td>
                            <a href="index.php?page=update_voucher&id=' . $vc['id'] . '" class="btn-edit"><i class="bx bx-edit"></i></a>
                            <a href="index.php?page=delete_voucher&id=' . $vc['id'] . '" class="btn-delete"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>shopdep</td>
                        <td>15 %</td>
                        <td>20/10/2023</td>
                        <td>20/12/2023</td>
                        <td>
                            <a href="index.php?page=update_voucher&id=' . $vc['id'] . '" class="btn-edit"><i class="bx bx-edit"></i></a>
                            <a href="index.php?page=delete_voucher&id=' . $vc['id'] . '" class="btn-delete"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>KKFASHION</td>
                        <td>20 %</td>
                        <td>20/10/2023</td>
                        <td>20/12/2023</td>
                        <td>
                            <a href="index.php?page=update_voucher&id=' . $vc['id'] . '" class="btn-edit"><i class="bx bx-edit"></i></a>
                            <a href="index.php?page=delete_voucher&id=' . $vc['id'] . '" class="btn-delete"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>

    </main>
</section>