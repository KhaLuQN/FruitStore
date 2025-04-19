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
        <h2>{{ config('apps.Category.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><strong><a href="{{ route('products.index') }}">{{ config('apps.Category.title') }}</a></strong></li>
            <li><strong><a href="{{ route('products.create') }}">{{ config('apps.Category.table1') }}</a></strong>
            </li>
        </ol>
    </div>
</div>
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th>Tên Danh mục</th>
                <th>Ảnh</th>
                <th>Mô tả</th>

                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>

                    <td> <img src="{{ asset('storage/categories/' . $category->image) }}" alt="category Image"
                            width="100"></td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <!-- xoá danh mục -->

                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this item?');"
                            class="product-action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button action-button--delete" title="Delete">
                                <img src="{{ asset('storage/iconFun/trash.png') }}" alt="Delete"
                                    class="action-button__icon">
                            </button>
                        </form>

                        <!-- Sửa Danh mục -->
                        <form action="{{ route('categories.edit', $category) }}" method="GET"
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
</div>
