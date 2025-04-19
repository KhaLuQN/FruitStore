@extends('frontend.welcome')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Lịch sử đơn hàng</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    @foreach ($orders as $order)
        <div class="container mt-4">
            <div class="d-flex align-items-center border p-3 bg-light">
                <!-- ID Order -->
                <div class="me-4">
                    <strong>mã đơn hàng :#</strong> {{ $order->id }}
                </div>

                <!-- Số lượng sản phẩm -->
                <div class="me-4">
                    <strong>Số lượng sản phẩm:</strong> {{ $order->orderItems->count() }}
                </div>

                <!-- Tổng giá -->
                <div class="me-4">
                    <strong>Tổng giá:</strong> {{ number_format($order->final_total, 0, ',', '.') }} VNĐ
                </div>

                <!-- Địa chỉ gửi -->
                <div class="me-4">
                    Gửi đến: {{ $order->receiver_address }}
                </div>

                <!-- Nút Chi tiết -->
                <div class="ms-auto">
                    <button class="btn btn-primary me-2" data-bs-toggle="collapse"
                        data-bs-target="#orderDetails{{ $order->id }}" aria-expanded="false"
                        aria-controls="orderDetails{{ $order->id }}">Chi tiết</button>
                    <a href="" style="background-color: #f37a27; color:black;" class="btn ">
                        Mua lại
                    </a>
                </div>
            </div>
        </div>

        <!-- Phần chi tiết đơn hàng -->
        <div id="orderDetails{{ $order->id }}" class="collapse container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                        <div class="card-body p-5">
                            <p class="lead fw-bold mb-5" style="color: #f37a27;">Tên người nhận: {{ $order->receiver_name }}
                            </p>

                            <div class="row">
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">Ngày mua</p>
                                    <p>{{ $order->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="col mb-3">
                                    <p class="small text-muted mb-1">ID Đơn hàng</p>
                                    <p>{{ $order->id }}</p>
                                </div>
                            </div>

                            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                                @foreach ($order->orderItems as $item)
                                    <div class="row">
                                        <div class="col-md-4 col-lg-6">
                                            <p>{{ $item->product->name }}</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <p>x{{ $item->quantity }}</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <p>{{ number_format($item->total_price, 0, ',', '.') }} VNĐ</p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach

                                <div class="row">
                                    <div class="col-md-8 col-lg-9">
                                        <p class="mb-0">Vận chuyển</p>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <p class="mb-0">Miễn phí</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row my-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-center lead fw-bold  pb-2" style="color: #f37a27;">Trạng thái</p>
                                        <p class="lead  pb-2" style="color: #27f350;">
                                            @if ($order->status == 'pending')
                                                Đang xử lý
                                            @elseif ($order->status == 'processing')
                                                Đang chuẩn bị đơn hàng
                                            @elseif ($order->status == 'out_for_delivery')
                                                Đang vận chuyển
                                            @else
                                                {{ $order->status }}
                                            @endif
                                        </p>

                                    </div>

                                    <div class="col-md-4 col-lg-3 text-center">
                                        <p class="lead fw-bold mb-0" style="color: #f37a27;">
                                            {{ number_format($order->final_total, 0, ',', '.') }} VNĐ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <p>ghi chú : {{ $order->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-12">
        <div class="pagination d-flex justify-content-center mt-5">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
