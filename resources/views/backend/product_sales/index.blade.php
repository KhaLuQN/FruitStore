<style>
    .product-action-form {
        display: inline;
    }

    .action-button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: opacity 0.3s ease;
        padding: 10px
    }

    .action-button:hover {
        opacity: 0.7;
    }

    .action-button__icon {
        width: 24px;
        height: 24px;
        vertical-align: middle;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Quản lý khuyến mãi</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><strong><a href="#">Quản lý khuyến mãi</a></strong></li>
            <li><strong><a href="#">sản phẩm</a></strong>
            </li>
        </ol>
    </div>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>ID </th>
            <th>Tên </th>
            <th>Ảnh </th>
            <th>Giá</th>
            <th>% giảm</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td><input type="checkbox" value="" class="input-checkbox checkBoxItem"></td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image"
                            width="100">
                    @else
                        <img src="{{ asset('storage/products/errorimg.png') }}" alt="Product Image" width="100">
                    @endif
                </td>

                <td class="money">{{ $product->price }}VND</td>
                <td>
                    <form action="{{ route('products.updateDiscount', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="discount_percentage" value="{{ $product->discount_percentage }}"
                            min="0" max="100" required>
                        <button type="submit">Cập nhật</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('products.updateSale', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Sử dụng PUT vì bạn đang cập nhật dữ liệu -->
                        <input class="js-switch" type="checkbox" name="is_sale" {{ $product->is_sale ? 'checked' : '' }}
                            onchange="this.form.submit()">
                    </form>

                </td>

            </tr>
        @endforeach
    </tbody>
</table>
