<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.products.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li>
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.products.titleedit') }}</strong></li>
        </ol>
    </div>
</div>
<div style="min-height: 660px" class="ibox-content mt-50">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group mb-3">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group form-group mb-3">
            <label class="control-label">Danh mục</label>
            <div class="">
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group mb-3">
            <label for="description">Mô tả ngắn sản phẩm:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Giá:</label>
            <input type="number" name="price" id="price" class="form-control"
                value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" class="form-control"
                value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <div class="form-group">
            <label class="control-label">xuất sứ</label>
            <div class="">
                <select name="product_type" class="form-control" required>
                    <option value="imported">Nhập khẩu</option>
                    <option value="domestic">Nội địa</option>
                </select>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="image">Hình ảnh:</label>
            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail"
                        style="width: 150px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="expiration_date">Ngày hết hạn:</label>
            <input type="date" name="expiration_date" id="expiration_date" class="form-control"
                value="{{ old('expiration_date', $product->expiration_date_formatted) }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
