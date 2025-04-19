@extends('frontend.welcome')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">cart</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Thông tin người nhận</h1>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">
                            <label class="form-label my-3">Tên người nhận<sup>*</sup></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $name ?? '') }}"
                                required>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại người nhận<sup>*</sup></label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', $phone ?? '') }}" required>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ giao hàng<sup>*</sup></label>
                            <input type="text" class="form-control" name="address"
                                value="{{ old('address', $address ?? '') }}" required>
                        </div>

                        <hr>

                        <div class="form-item">
                            <textarea name="notes" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Ghi chú">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $index => $item)
                                        <tr>
                                            <td><img src="{{ asset('storage/products/' . $item['product']['image']) }}"
                                                    alt="{{ $item['product']['name'] }}" width="90" height="90"></td>
                                            <td>{{ $item['product']['name'] }}</td>
                                            <td>${{ number_format($item['product']['price'], 2) }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>${{ number_format($item['quantity'] * $item['product']['price'], 2) }}</td>

                                            <!-- Truyền thông tin giỏ hàng qua hidden fields -->
                                            <input type="hidden" name="cart[{{ $index }}][product_id]"
                                                value="{{ $item['product']['id'] }}">
                                            <input type="hidden" name="cart[{{ $index }}][quantity]"
                                                value="{{ $item['quantity'] }}">
                                            <input type="hidden" name="cart[{{ $index }}][price]"
                                                value="{{ $item['product']['price'] }}">
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-3">Giá</p>
                                        </td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">${{ $total }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-1">
                                            <p class="mb-0 text-dark py-4">Mã giảm giá</p>
                                        </td>
                                        <td colspan="3" class="py-1">
                                            <p class="mb-0 text-dark py-4 fs-4">{{ $discount }}%</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-1">Shipping</p>
                                        </td>
                                        <td colspan="3" class="py-5">
                                            <p class="mb-0 text-dark py-1 fs-4">FreeShip</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">Số tiền cần thanh toán</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">${{ $finalTotal }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <p class="text-start text-dark">Phương thức thanh toán</p>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1"
                                        name="Paypal" value="Paypal" checked>
                                    <label class="form-check-label" for="Paypal-1">COD</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="total" value="{{ $total }}">
                        <input type="hidden" name="discount" value="{{ $discount }}">



                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button name="redirect" type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Thanh
                                toán</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
