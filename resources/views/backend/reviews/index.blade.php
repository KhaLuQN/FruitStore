<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>ID</th>
            <th>ID_sản phẩm</th>
            <th>ID_User</th>
            <th>Đánh giá</th>
            <th>Comment</th>
            <th>Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
            <tr>
                <td><input type="checkbox" value="" class="input-checkbox checkBoxItem"></td>
                <td>{{ $review->id }}</td>
                <td>{{ $review->product_id }}</td>
                <td>{{ $review->user_id }}</td>
                <td>
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                </td>
                <td>{{ $review->comment }}</td>
                <td><input type="checkbox" class="js-switch" checked></td>


                <td>
                    <form action="{{ route('review.destroy', $review->id) }}" method="POST"
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
    {{ $reviews->links('pagination::bootstrap-4') }}
</div>
