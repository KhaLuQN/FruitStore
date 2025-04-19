@extends('frontend.welcome')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->product->price }}đ</p>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        @method('POST')


                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">

                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <!-- Nút giảm -->
                                                <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}"
                                                    class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>

                                            <!-- Input số lượng sản phẩm -->
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                name="quantity" value="{{ $item->quantity }}">

                                            <div class="input-group-btn">
                                                <!-- Nút tăng -->
                                                <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                                    class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>


                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->quantity * $item->product->price }}đ</p>
                                </td>
                                <td>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Giỏ hàng của bạn trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <form action="{{ route('discount.apply') }}" method="POST">
                    @csrf
                    <input type="text" name="discount_code" class="border-0 border-bottom rounded me-5 py-3 mb-4"
                        placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="submit">Apply
                        Coupon</button>
                </form>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">${{ $total }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Mã giảm giá:</h5>
                                <p class="mb-0">{{ $discount }}%</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Giá: free</p>
                                </div>
                            </div>

                            <p class="mb-0 text-end">Ship trong nội thành đà nẵng</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">
                                {{ $finalTotal }}
                            </p>
                        </div>


                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart_items" value="{{ json_encode($cartItems) }}">
                            <input type="hidden" name="total_price" value="{{ $total }}">
                            <input type="hidden" name="discount" value="{{ $discount }}">
                            <input type="hidden" name="final_total" value="{{ $finalTotal }}">

                            <button
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="submit">
                                Tiến hành thanh toán
                            </button>
                        </form>



                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
