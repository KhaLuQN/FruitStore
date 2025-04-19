<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">123 Street, Đà Nẵng</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">khappp4@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>

    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('home') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ request()->is('home') ? 'active' : '' }}">Trang Chủ</a>
                    <a href="{{ route('allproduct') }}"
                        class="nav-item nav-link {{ request()->is('allproduct') ? 'active' : '' }}">Tất cả sản phẩm</a>
                    <a
                        class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }} "href="{{ route('contact') }}">contact</a>
                </div>
                <div class="d-flex m-3 me-0">

                    <a href="{{ route('order.show') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-box fa-2x"></i>

                    </a>
                    <a href="{{ route('cart.show') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            {{ session('cart_quantity', 0) }}
                        </span>
                    </a>





                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                            class="fas fa-bars"></i></button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel"> chào người dùng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class=" d-flex align-items-center  flex-column offcanvas-body">
                            @auth
                                <a class="nav-item nav-link" href="{{ route('user.show') }}">Thông tin tài khoản</a>
                                <a class="nav-item nav-link" href="{{ route('order.history') }}">Lịch sử đơn hàng</a>
                                <a class="nav-item nav-link" href="#">Hổ trợ </a>
                                <a class="nav-item nav-link" href="{{ route('auth.logout') }}">Đăng xuất</a>
                                @if (auth()->user()->role === 'admin')
                                    <a class="nav-item nav-link" href="{{ route('dashboard.index') }}">Trang quản trị</a>
                                @endif
                            @else
                                <a class="nav-item nav-link" href="{{ route('login') }}">Đăng nhập</a>
                            @endauth

                        </div>
                    </div>







                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
