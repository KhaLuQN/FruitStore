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
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-9"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        @include('frontend.partials.extra')

                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="{{ route('detailproduct', ['id' => $product->id]) }}">
                                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                                        class="img-fluid w-100 rounded-top" alt="">
                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $product->category->name }}</div>
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
                                                    <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }} / kg</p>
                                                    <form class="d-flex justify-content-end"
                                                        action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary d-flex align-items-center justify-content-center"
                                                            style="width: 50px; height: 50px;">
                                                            <i class="fa fa-shopping-bag text-primary fa-2x"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
