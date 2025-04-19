<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tình trạng</th>

            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><input type="checkbox" value="" class="input-checkbox checkBoxItem"></td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td><input type="checkbox" class="js-switch" checked></td>

                <td>



                    <!-- Button trigger modal -->
                    <button type="button" data-toggle="modal" data-target="#staticBackdrop-{{ $user->id }}">
                        <img style="width: 20px" height="20px" src="{{ asset('storage/iconFun/edit.png') }}"
                            alt="Edit" class="action-button__icon">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop-{{ $user->id }}" data-backdrop="static"
                        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-{{ $user->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel-{{ $user->id }}">Sửa thông tin
                                        người dùng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editUserForm-{{ $user->id }}"
                                        action="{{ route('user.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name-{{ $user->id }}">Tên người dùng</label>
                                            <input type="text" class="form-control" id="name-{{ $user->id }}"
                                                name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email-{{ $user->id }}">Email</label>
                                            <input type="email" class="form-control" id="email-{{ $user->id }}"
                                                name="email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email-{{ $user->phone }}">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone-{{ $user->id }}"
                                                name="phone" value="{{ $user->phone }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email-{{ $user->address }}">Địa chỉ</label>
                                            <input type="text" class="form-control" id="phone-{{ $user->address }}"
                                                name="address" value="{{ $user->address }}" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary"
                                        form="editUserForm-{{ $user->id }}">Lưu thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="display: flex; justify-content: center;">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
