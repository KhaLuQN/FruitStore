@extends('frontend.welcome')
@section('content')
    <div style="margin-top: 150px" class="container rounded bg-white  mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="http://localhost/app/public/storage//users/{{ $user->image }}"
                        class="font-weight-bold">{{ $user->name }}</span><span
                        class="text-black-50">{{ $user->email }}</span><span>
                    </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Tên người dùng</label>
                            <input type="text" class="form-control" placeholder="name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">phone</label>
                            <input type="text" class="form-control" placeholder="Số điện thoại"
                                value="{{ $user->phone }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="email" class="form-control" placeholder="email" value="{{ $user->email }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="address" value="{{ $user->address }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="password" value="">
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">sửa</button>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên người dùng</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $user->phone }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $user->address }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="******">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Hình ảnh đại diện</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
@endsection
