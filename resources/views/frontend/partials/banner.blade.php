<div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="py-4">
                    <h1 class="display-3 text-white">Sản phẩm đang giảm giá</h1>
                    <p class="fw-normal display-3 text-dark mb-4">{{ $maxDiscountProduct->name }}</p>
                    <p class="mb-4 text-dark">{{ $maxDiscountProduct->description }}</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf

                        @csrf
                        <input type="hidden" name="product_id" value="{{ $maxDiscountProduct->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">
                            BUY
                        </button>


                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="{{ asset('storage/products/' . $maxDiscountProduct->image) }}"
                        class="img-fluid w-100 rounded" alt="">
                    <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                        style="width: 140px; height: 140px; top: 0; left: 0;">

                        <div class="d-flex flex-column">
                            <span style="color:red;"
                                class="h2 mb-0">{{ $maxDiscountProduct->discount_percentage }}%</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
