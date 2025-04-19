<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.Category.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><strong><a href="{{ route('products.index') }}">{{ config('apps.Category.title') }}</a></strong></li>
            <li><strong><a href="{{ route('products.create') }}">{{ config('apps.Category.table2') }}</a></strong>
            </li>
        </ol>
    </div>
</div>
<div class="container col-sm-5">
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
        class="p-3 border rounded shadow-sm">
        @csrf

        <div class="form-group mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" name="name" id="name" class="form-control" required
                placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group mb-3" id="imagePreviewContainer1">
            <div class="dropzone"
                style="border: 2px dashed #007bff; padding: 20px; text-align: center; cursor: pointer;">

                <img id="imagePreview1" src="#" alt="Image Preview"
                    style="display:none; max-width: 400px; margin-top: 10px;">
            </div>
            <input type="file" name="image" id="productImage1" class="form-control" accept="image/*"
                style="display:none;">
            <button type="button" id="removeImageBtn1" style="display:none; margin-top: 10px;"
                class="btn btn-danger">Xoá</button>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả danh mục"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Lưu</button>
    </form>

</div>
