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
        padding: 10px;
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
        <h2>{{ config('apps.Discounts.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><strong><a href="{{ route('products.index') }}">{{ config('apps.Discounts.title') }}</a></strong></li>
            <li><strong><a href="{{ route('products.create') }}">{{ config('apps.Discounts.title2') }}</a></strong>
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
            <th>CODE </th>
            <th>% Giảm</th>
            <th>Sô lượng</th>
            <th>Đã được sử dụng</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Ngày tạo</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($discounts as $discount)
            <tr>
                <td><input type="checkbox" value="{{ $discount->id }}" class="input-checkbox"></td>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->code }}</td>
                <td>{{ $discount->percentage }}%</td>
                <td>{{ $discount->quantity }}</td>
                <td>{{ $discount->usage_count }}</td>
                <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($discount->created_at)->format('d/m/Y') }}</td>

                <td>
                    <!-- Xóa sản phẩm -->
                    <form action="{{ route('DiscountController.destroy', $discount) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                        class="product-action-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-button action-button--delete" title="Delete">
                            <img src="{{ asset('storage/iconFun/trash.png') }}" alt="Delete"
                                class="action-button__icon">
                        </button>
                    </form>



                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('backend.discounts.add')
