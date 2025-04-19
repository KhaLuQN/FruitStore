<div class="container-fluid vesitable ">
    <div class="container py-5">

        <div class="owl-carousel vegetable-carousel justify-content-center">
            @foreach ($vegetableProducts as $product)
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <a href="{{ route('detailproduct', ['id' => $product->id]) }}">
                            <img style="width: 100%; height: 250px; object-fit: cover;"
                                src="{{ asset('storage/products/' . $product->image) }}"
                                class="img-fluid w-100 rounded-top" alt="">
                        </a>
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">
                        {{ $vegetableCategory->name }}</div>
                    <div class="p-4 rounded-bottom">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->description }}</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0"> <span class="money">{{ $product->price }}</span>
                                đ/kg</p>
                            <form action="{{ route('cart.add') }}" method="POST">
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
            @endforeach

        </div>
    </div>
</div>
