<div class="container col-sm-10">
    <h1>Sữa Danh mục</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label">Tên danh mục:</label>
            <input type="text" name="name" id="name" class="form-control" required
                placeholder="Nhập tên danh mục" value="{{ $category->name }}">
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
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Nhập mô tả danh mục">{{ $category->description }}</textarea>
        </div>








        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
