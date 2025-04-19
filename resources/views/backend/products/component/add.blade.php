<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.products.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px">
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li><strong><a href="{{ route('products.index') }}">{{ config('apps.products.title') }}</a></strong></li>
            <li><strong><a href="{{ route('products.create') }}">{{ config('apps.products.table2') }}</a></strong>
            </li>
        </ol>
    </div>
</div>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf



    <div class="wrapper wrapper-content animated fadeInRight ecommerce" style="padding-bottom: 120px">
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" placeholder="Product name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Price:</label>
                <div class="col-sm-5">
                    <input type="text" name="price" class="form-control" placeholder="$160.00" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Danh mục</label>
                <div class="col-sm-5">
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">xuất sứ</label>
                <div class="col-sm-5">
                    <select name="product_type" class="form-control" required>
                        <option value="imported">Nhập khẩu</option>
                        <option value="domestic">Nội địa</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Mô tả ngắn:</label>
                <div class="col-sm-5">
                    <textarea name="description" class="form-control summernote" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">mô tả dài :</label>
                <div class="col-sm-5">
                    <textarea name="long_description" class="form-control summernote" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ảnh :</label>
                <div class="col-sm-10">
                    <div class="row" id="imagePreviewsContainer"
                        style="display: flex; justify-content: space-between;">

                        <!-- Ảnh chính -->
                        <div class="col-sm-3" id="imagePreviewContainer1">
                            <div class="dropzone"
                                style="border: 2px dashed #007bff; padding: 20px; text-align: center; cursor: pointer;">
                                <p>Ảnh chính</p>
                                <img id="imagePreview1" src="#" alt="Image Preview"
                                    style="display:none; max-width: 200px; margin-top: 10px;">
                            </div>
                            <input type="file" name="product_image" id="productImage1" class="form-control"
                                accept="image/*" style="display:none;">
                            <button type="button" id="removeImageBtn1" style="display:none; margin-top: 10px;"
                                class="btn btn-danger">Xoá</button>
                        </div>

                        <!-- Ảnh phụ 1 -->
                        <div class="col-sm-3" id="imagePreviewContainer2">
                            <div class="dropzone"
                                style="border: 2px dashed #007bff; padding: 20px; text-align: center; cursor: pointer;">
                                <p>Ảnh phụ 1</p>
                                <img id="imagePreview2" src="#" alt="Image Preview"
                                    style="display:none; max-width: 200px; margin-top: 10px;">
                            </div>
                            <input type="file" name="additional_image_1" id="productImage2" class="form-control"
                                accept="image/*" style="display:none;">
                            <button type="button" id="removeImageBtn2" style="display:none; margin-top: 10px;"
                                class="btn btn-danger">Xoá</button>
                        </div>

                        <!-- Ảnh phụ 2 -->
                        <div class="col-sm-3" id="imagePreviewContainer3">
                            <div class="dropzone"
                                style="border: 2px dashed #007bff; padding: 20px; text-align: center; cursor: pointer;">
                                <p>Ảnh phụ 2</p>
                                <img id="imagePreview3" src="#" alt="Image Preview"
                                    style="display:none; max-width: 200px; margin-top: 10px;">
                            </div>
                            <input type="file" name="additional_image_2" id="productImage3" class="form-control"
                                accept="image/*" style="display:none;">
                            <button type="button" id="removeImageBtn3" style="display:none; margin-top: 10px;"
                                class="btn btn-danger">Xoá</button>
                        </div>

                        <!-- Ảnh phụ 3 -->
                        <div class="col-sm-3" id="imagePreviewContainer4">
                            <div class="dropzone"
                                style="border: 2px dashed #007bff; padding: 20px; text-align: center; cursor: pointer;">
                                <p>Ảnh phụ 3</p>
                                <img id="imagePreview4" src="#" alt="Image Preview"
                                    style="display:none; max-width: 200px; margin-top: 10px;">
                            </div>
                            <input type="file" name="additional_image_3" id="productImage4" class="form-control"
                                accept="image/*" style="display:none;">
                            <button type="button" id="removeImageBtn4" style="display:none; margin-top: 10px;"
                                class="btn btn-danger">Xoá</button>
                        </div>

                    </div>
                </div>
            </div>





            <div class="form-group">
                <label class="col-sm-2 control-label">số lượng trong kho:</label>
                <div class="col-sm-5">
                    <input type="number" name="quantity" class="form-control" placeholder="số lượng" required>
                </div>
            </div>

            <div class="form-group">
                <label class=" col-sm-2 control-label">Ngày hết hạn:</label>
                <div class="col-sm-5">
                    <input type="date" name="expiration_date" class="form-control money" required>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-white" type="reset">Cancel</button>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
        </div>
    </div>
</form>



<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
