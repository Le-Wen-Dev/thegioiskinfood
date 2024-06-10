@include('Admins/header')


<!-- SIDEBAR -->
@include('Admins/menu')
<?php

use App\Models\Bills;
use App\Models\Products;
use App\Models\Users;

$number_of_orders = Bills::where('status', 3)->count();
$number_of_products = Products::count();
$number_of_users = Users::count();
?>
<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>

        <form action="#">
            <div class="form-input">

            </div>
        </form>

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
                <h1>Quản Trị Viên</h1>
            </div>
            <!-- <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a> -->
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text c-bill">
                    <h3>{{$number_of_orders}}</h3>
                    <p>Đơn Hàng</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text c-user">
                    <h3>{{$number_of_users}}</h3>
                    <p>Tài Khoản</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-category'></i>
                <span class="text c-product">
                    <h3>{{$number_of_products}}</h3>
                    <p>Sản Phẩm</p>
                </span>
            </li>
        </ul>
        <div class="row ">
            <div class="col"> <canvas id="myChart" width="400" height="400"></canvas></div>
            <div class="col">
                <table class=" table bordered">
                    <thead>
                        <tr>
                            <th>Tháng</th>
                            <th>Số lượng sản phẩm bán được</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tháng 1</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>Tháng 2</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>Tháng 3</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Tháng 4</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>Tháng 5</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Tháng 6</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Tháng 7</td>
                            <td>7</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <script>
        // Dữ liệu biểu đồ
        var data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Cài đặt các tùy chọn của biểu đồ
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Lấy thẻ canvas để vẽ biểu đồ
        var ctx = document.getElementById('myChart').getContext('2d');

        // Tạo biểu đồ
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        </script>
        <!-- <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Đơn Hàng Chưa Được Xác Nhận</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <p class="err">
                    message
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Khách Hàng</th>
                            <th>Ngày Đặt Hàng</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                <p class="text-center">Bạn Không Có Đơn Hàng Cần Xác Nhận</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->

    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->