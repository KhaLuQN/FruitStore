@extends('frontend.welcome')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">ĐĂNG NHẬP</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Login</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <div class="container  py-1">
        <div class="container d-flex justify-content-center  ">
            <div class="p-5 col-6  bg-light rounded">
                <div class=" text-center  ibox-content">
                    <form method="POST" class="m-t" role="form" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="form-group ">
                            <input name="email" type="email" class="form-control" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="errors-message">*{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group py-4">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="errors-message">*{{ $errors->first('password') }}</span>
                            @endif

                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b"> Login </button> <br>

                        <a href="{{ route('password.request') }}">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center  ">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-primary block full-width m-b" href="{{ route('register') }}">Create an account</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
