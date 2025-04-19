<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Sản phẩm Được mua nhiều nhất</h1>
            <p>"Sản phẩm chất lượng , được nhiều người dùng đánh giá cao!"</p>
        </div>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach ($bestSellingProducts as $product)
                <div class="border border-primary rounded position-relative vesitable-item">
                    <!-- Thêm nhãn SALE -->
                    <div class="vesitable-img sale-img">

                        <a href="{{ route('detailproduct', ['id' => $product->id]) }}">
                            <img style="width: 100%; height: 250px; object-fit: cover;"
                                src="{{ asset('storage/products/' . $product->image) }}"
                                class="img-fluid w-100 rounded-top" alt="">
                        </a>
                    </div>
                    <div class="p-2 rounded-bottom ">
                        <h4 class="text-center ">{{ $product->name }}</h4>


                        <div class="d-flex align-items-center justify-content-center" style="font-size: 12px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fa fa-star {{ $i <= $product->average_rating ? 'text-warning' : 'text-muted' }}">
                                </i>
                            @endfor
                        </div>
                        <br>

                        <div class="d-flex flex-column justify-content-between ">
                            <p class="text-dark fs-5 fw-bold mb-0"> <span class="money">{{ $product->price }}</span>
                                đ/kg</p>

                        </div>

                        <form class="d-flex justify-content-end" action="{{ route('cart.add') }}" method="POST">
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
            @endforeach

        </div>
    </div>
</div>
