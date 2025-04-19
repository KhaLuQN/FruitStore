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
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc khi thực hiện thao tác này ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <img src="{{ asset('storage/iconFun/trash.png') }}" alt="Delete"
                                style="width: 24px; height: 24px;">
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="display: flex; justify-content: center;">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
