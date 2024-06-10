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
                <h1>Quản Lý Tài Khoản</h1>
            </div>
        </div>

        <div class="admin_user">
            <a href="index.php?page=create-user">Thêm Tài Khoản Mới</a>
            <p class="err">
                <?php
                if (isset($_SESSION["message"])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </p>
            <table class="table">
                <thead>
                    <th>Tài Khoản</th>
                    <th>Email</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </thead>

                <tbody>
                    <tr>
                        <td>phuoc01</td>
                        <td>mauphuoc@gmai.com</td>
                        <td>Đang hoạt động</td>
                        <td>
                            <a href="index.php?page=update-user&id=' . $acc['id'] . '"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>hung324</td>
                        <td>hung@gmai.com</td>
                        <td>Khóa</td>
                        <td>
                            <a href="index.php?page=update-user&id=' . $acc['id'] . '"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>phuong1</td>
                        <td>myphuong@gmai.com</td>
                        <td>Đang hoạt động</td>
                        <td>
                            <a href="index.php?page=update-user&id=' . $acc['id'] . '"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>vi</td>
                        <td>tuongvi@gmai.com</td>
                        <td>Đang hoạt động</td>
                        <td>
                            <a href="index.php?page=update-user&id=' . $acc['id'] . '"><i class="bx bx-edit"></i></a>
                            <a href="/"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </main>
</section>