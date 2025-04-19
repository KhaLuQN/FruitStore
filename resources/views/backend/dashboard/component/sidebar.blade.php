<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header d-flex">
            <div style="display: flex; flex-direction:column; align-items:center " class=" dropdown profile-element ">
                <span>
                    <img alt="image" style="width: 100px; border-radius:100% "class="img-thumbnail  "
                        src="storage/users/{{ $user->image ?? 'avatar.jpg' }}" />
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="{{ route('dashboard.index') }}">
                    <span class="clear">
                        <span class="block m-t-xs">
                            <strong class="font-bold">{{ session('user_name') }}
                            </strong>
                        </span>
                    </span>
                </a>

            </div>

        </li>
        <li class="active">
            <a href="{{ route('dashboard.index') }}" class="text-center">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-label">Dashboard</span>

            </a>

        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý thành viên</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{ route('user.index') }}">Tất cả khách hàng</a></li>

            </ul>
        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý nhân viên</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('staff.index') }}"> Tất cả nhân viên</a></li>
                <li><a href="{{ route('user.create') }}">thêm nhân viên</a></li>
            </ul>
        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý Danh mục</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('categories.index') }}"> Tất cả Danh mục</a></li>
                <li><a href="{{ route('categories.create') }}">thêm Danh mục</a></li>
            </ul>
        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý sản phẩm</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('products.index') }}"> Tất cả sản phẩm</a></li>
                <li><a href="{{ route('products.create') }}">thêm sản Phẩm</a></li>
            </ul>
        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý Đơn hàng</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('manage_order.index') }}"> Tất cả đơn hàng</a></li>

            </ul>
        </li>

        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý khuyến mãi</span> <span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('product_sales.index') }}"> Sales</a></li>
                <li><a href="{{ route('discounts.indexcode') }}">Mã Giảm Giá </a></li>
            </ul>
        </li>
        <li class="active">
            <a href="#"><i class="fa fa-th-large"></i>
                <span class="nav-label">Quản lý Đánh giá
                    <span class="fa arrow"></span>
                </span></a>
            <ul class="nav nav-second-level">
                <li><a class="active" href="{{ route('reviews.index') }}"> Tất cả Đánh giá</a></li>

            </ul>
        </li>

    </ul>

</div>
