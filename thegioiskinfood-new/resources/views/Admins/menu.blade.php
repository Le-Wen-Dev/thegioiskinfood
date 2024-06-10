<section id="sidebar">
    <a href="/" class="brand ml-4">
        <img src="{{ asset('img/logo.webp') }}" height='50px' alt="">
    </a>
    <ul class="side-menu top">
        <li class="{{ Request::routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}">
                <i class='bx bxs-home'></i>
                <span class="text">Trang Chủ</span>
            </a>
        </li>
        <li class="{{ Request::routeIs('admin.showcategories') ? 'active' : '' }}">
            <a href="{{ route('admin.showcategories') }}">
                <i class='bx bxs-category-alt'></i>
                <span class="text">Danh Mục</span>
            </a>
        </li>
        <li class="{{ Request::routeIs('admin.product') ? 'active' : '' }}">
            <a href="{{ route('admin.products.showproduct') }}">
                <i class='bx bxs-window-alt'></i>
                <span class="text">Sản Phẩm</span>
            </a>
        </li>
        <li class="{{ Request::routeIs('admin.bill') ? 'active' : '' }}">
            <a href="{{ route('admin.bill') }}">
                <i class='bx bxs-calendar-check'></i>
                <span class="text">Đơn Hàng</span>
                @php
                $billCount = \App\Models\Bills::where('status', 1)->count();
                @endphp
                @if($billCount > 1)
                <span class="position-absolute  translate-middle badge rounded-pill bg-danger">
                    {{ $billCount }}
                    <span class="visually-hidden">sản phẩm</span>
                    <span class="visually-hidden">unread messages</span>
                </span>
                @endif
            </a>
        </li>
        <li class="{{ Request::routeIs('admin.user') ? 'active' : '' }}">
            <a href="{{ route('admin.user') }}">
                <i class='bx bxs-group'></i>
                <span class="text">Tài Khoản</span>
            </a>
        </li>

    </ul>
    <ul class="side-menu">
        <li>
            <a href="/logout" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Đăng Xuất</span>
            </a>
        </li>
    </ul>
</section>