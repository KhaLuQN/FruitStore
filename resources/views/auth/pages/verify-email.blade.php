<!-- resources/views/auth/verify-email.blade.php -->
@extends('frontend.welcome')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Xác thực Email</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Xác thực Email</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Content Start -->
    <div class="container py-5">
        <div class="container d-flex justify-content-center">
            <div class="p-5 col-6 bg-light rounded">
                <h2 class="text-center mb-4">Kiểm tra Email của Bạn</h2>
                <p class="text-center">
                    Một liên kết xác thực đã được gửi đến địa chỉ email của bạn. Vui lòng kiểm tra email và nhấp vào liên
                    kết để xác thực tài khoản của bạn.
                </p>
                <p class="text-center">
                    Nếu bạn không nhận được email, vui lòng kiểm tra thư mục spam hoặc thử gửi lại liên kết xác thực bằng
                    cách nhấp vào nút dưới đây.
                </p>
                <div class="text-center">
                    <a href="#" class="btn btn-primary">Gửi lại Email Xác Thực</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
@endsection
