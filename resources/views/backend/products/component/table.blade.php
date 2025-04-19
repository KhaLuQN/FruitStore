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
            <th>Số Lượng</th>
            <th>Danh Mục</th>
            <th>Loại </th>
            <th>HSD (ngày)</th>
            <th>Sale</th>
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
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image" width="100">
                    @else
                        <img src="{{ asset('storage/products/errorimg.png') }}" alt="Product Image" width="100">
                    @endif
                </td>

                <td class="money">{{ $product->price }}VND</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category_id }}</td>
                <td>{{ $product->product_type }}</td>
                <td>{{ $product->HSD }}</td>
                <td>
                    <form action="{{ route('products.updateSale', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Sử dụng PUT vì bạn đang cập nhật dữ liệu -->
                        <input class="js-switch" type="checkbox" name="is_sale"
                            {{ $product->is_sale ? 'checked' : '' }} onchange="this.form.submit()">
                    </form>

                </td>
                <td>
                    <!-- Xóa sản phẩm -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                        class="product-action-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-button action-button--delete" title="Delete">
                            <img src="{{ asset('storage/iconFun/trash.png') }}" alt="Delete"
                                class="action-button__icon">
                        </button>
                    </form>

                    <!-- Sửa sản phẩm -->
                    <form action="{{ route('products.edit', $product->id) }}" method="GET"
                        class="product-action-form">
                        <button type="submit" class="action-button action-button--edit" title="Edit">
                            <img src="{{ asset('storage/iconFun/edit.png') }}" alt="Edit"
                                class="action-button__icon">
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="display: flex; justify-content: center;">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
