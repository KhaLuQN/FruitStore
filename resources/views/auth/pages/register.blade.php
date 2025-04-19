@extends('frontend.welcome')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">ĐĂNG Ký</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">đăng ký</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Register Start -->
    <div class="container py-5">
        <div class="container d-flex justify-content-center">
            <div class="p-5 col-6 bg-light rounded">
                <h2 class="text-center mb-4">Đăng ký tài khoản</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Họ và tên</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Địa chỉ email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Mật khẩu</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm">Xác nhận mật khẩu</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                    </div>


                </form>
                <div class="form-group text-center">
                    <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
@endsection
