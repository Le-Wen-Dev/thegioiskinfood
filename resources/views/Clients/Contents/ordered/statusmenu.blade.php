<section id="sidebar">

    <ul class="nav nav-tabs flex-column flex-sm-row">
        <!-- Thêm lớp CSS của Bootstrap -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('followorder') ? 'active' : '' }}" href="{{ route('followorder') }}">
                <i class='bx bxs-home'></i>
                <span class="text">Chờ Xác Nhận</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('delivering') ? 'active' : '' }}" href="{{ route('delivering') }}">
                <i class='bx bxs-category-alt'></i>
                <span class="text">Đang Giao Hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('reserved') ? 'active' : '' }}" href="{{ route('reserved') }}">
                <i class='bx bxs-category-alt'></i>
                <span class="text">Đã Nhận Hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('canceled') ? 'active' : '' }}" href="{{ route('canceled') }}">
                <i class='bx bxs-category-alt'></i>
                <span class="text">Đã Hủy</span>
            </a>
        </li>
    </ul>
</section>