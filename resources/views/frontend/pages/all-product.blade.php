@extends('frontend.welcome')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Tất cả sản Phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
            <li class="breadcrumb-item active text-white">Tất cả sản Phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container py-5">
        <h1 class="mb-4">Cửa hàng thực phẩm </h1>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="filter-container">

                    <form method="GET">
                        <input type="text" name="search" class="form-control mb-3" placeholder="Tìm kiếm sản phẩm..."
                            value="{{ request('search') }}">
                        <select name="category" class="form-control mb-4">
                            <option value="">Tất cả danh mục </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="number" name="min_price" class="form-control mb-3" placeholder="Giá từ"
                            value="{{ request('min_price') }}">
                        <input type="number" name="max_price" class="form-control mb-3" placeholder="Giá đến"
                            value="{{ request('max_price') }}">


                        <select name="rating" class="form-control mb-3">
                            <option value="">Tất cả đánh giá</option>
                            <option value="5-stars" {{ request('rating') == '5-stars' ? 'selected' : '' }}>Sản phẩm đánh giá
                                5 sao</option>
                            <option value="4-stars" {{ request('rating') == '4-stars' ? 'selected' : '' }}>Sản phẩm đánh giá
                                4 sao</option>
                            <option value="3-stars" {{ request('rating') == '3-stars' ? 'selected' : '' }}>Sản phẩm đánh giá
                                3 sao</option>
                            <option value="2-stars" {{ request('rating') == '2-stars' ? 'selected' : '' }}>Sản phẩm đánh giá
                                2 sao</option>
                            <option value="1-stars" {{ request('rating') == '1-stars' ? 'selected' : '' }}>Sản phẩm đánh
                                giá
                                1 sao</option>
                        </select>


                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </form>
                </div>
            </div>


            <div class="col-lg-9">
                <div class="row g-4 justify-content-center">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img"> <a href="{{ route('detailproduct', ['id' => $product->id]) }}">
                                        <img style="width: 100%; height: 250px; object-fit: cover;"
                                            src="{{ asset('storage/products/' . $product->image) }}"
                                            class="img-fluid w-100 rounded-top" alt=""> </a> </div>
                                <div class="text-white  px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px; background-color: #81c408 ">
                                    {{ $product->category->name }}
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4 class="text-center"> {{ $product->name }} </h4>
                                    <div class="m-4 d-flex align-items-center justify-content-center"
                                        style="font-size: 12px;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa fa-star {{ $i <= $product->average_rating ? 'text-warning' : 'text-muted' }}">
                                            </i>
                                        @endfor
                                    </div>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}đ / kg</p>
                                        <form class="d-flex justify-content-end" action="{{ route('cart.add') }}"
                                            method="POST"> @csrf <input type="hidden" name="product_id"
                                                value="{{ $product->id }}"> <input type="hidden" name="quantity"
                                                value="1"> <button type="submit"
                                                class="btn border border-secondary rounded-pill px-3 text-primary d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;"> <i
                                                    class="fa fa-shopping-bag text-primary fa-2x"></i> </button> </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="pagination d-flex justify-content-center mt-5">
                            {{ $products->links('pagination::bootstrap-4') }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fruits Shop End-->
@endsection
