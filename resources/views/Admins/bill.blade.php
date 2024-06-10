@include('Admins/header')


<!-- SIDEBAR -->

@include('Admins/menu')
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="/admin" class="nav-link">Trang Chủ</a>
        <form action="{{route('admin.searchbill')}}" method="GET">
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
            <img src="img/people.png">
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Đơn Hàng</h1>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="tab_bill">
                    <div class="tab_bill_item">
                        <ul class="nav nav-tabs flex-column flex-sm-row">
                            <!-- Thêm lớp CSS của Bootstrap -->
                            <li class="nav-item m-2">
                                <a class="nav-link {{ Request::routeIs('admin.bill') ? 'active' : '' }}"
                                    href="{{ route('admin.bill') }}">

                                    <span class="text">Chờ Xác Nhận</span>
                                </a>
                            </li>
                            <li class="nav-item  m-2">
                                <a class="nav-link {{ Request::routeIs('admin.delivering') ? 'active' : '' }}"
                                    href="{{ route('admin.delivering') }}">

                                    <span class="text">Đang Giao Hàng</span>
                                </a>
                            </li>
                            <li class="nav-item  m-2">
                                <a class="nav-link {{ Request::routeIs('admin.reserved') ? 'active' : '' }}"
                                    href="{{ route('admin.reserved') }}">

                                    <span class="text">Đã Nhận Hàng</span>
                                </a>
                            </li>
                            <li class="nav-item  m-2">
                                <a class="nav-link {{ Request::routeIs('admin.canceled') ? 'active' : '' }}"
                                    href="{{ route('admin.canceled') }}">

                                    <span class="text">Đã Hủy</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <table class="table table-show-category show-table">
                    <thead>
                        <tr>
                            @php
                            $statusNames = [
                            1 => 'Chờ Xác Nhận',
                            2 => 'Đang Giao Hàng',
                            3 => 'Đã Nhận Hàng',
                            4 => 'Đã Hủy'
                            ];
                            @endphp
                            <th>Trạng Thái</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Tên Người Đặt Hàng</th>
                            <th>Số Lượng Sản Phẩm</th>
                            <th>Ngày Đặt Hàng</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bill as $bill)
                        @php
                        $productData = json_decode($bill->product, true);
                        $productCount = count($productData);
                        @endphp
                        <tr>
                            <td>
                                <form action="{{ route('updateStatus', $bill->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-dark">
                                        {{ $statusNames[$bill->status] }}
                                    </button>
                                </form>
                            </td>
                            <td><a href="/admin/detailbill/{{ $bill->id }}">{{ $bill->id_bill }}</a> </td>
                            <td>{{ $bill->user->name }}</td>
                            <td>{{ $productCount }}</td>
                            <td>{{ $bill->created_at }}</td>
                            <td class="text-danger">
                                <strong>{{ number_format($bill->totalfinal, 3, ',', '.') . 'đ' }}</strong>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <!-- MAIN -->
</section>