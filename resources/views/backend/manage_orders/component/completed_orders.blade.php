<!-- all_orders.blade -->

<table class="table table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>SĐT</th>
            <th>Created At</th>
            <th>Trạng thái</th>
            <th>xem chi tiết</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($completedOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->receiver_phone }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <button class="btn btn-info view-details"
                        data-target="#order-details-{{ $order->id }}">View</button>
                </td>

            </tr>

            <!-- Chi tiết đơn hàng -->
            <tr id="order-details-{{ $order->id }}" class="order-details-row" style="display: none;">
                <td colspan="6">
                    <div>
                        <strong>Địa chỉ giao hàng:</strong>
                        <p>{{ $order->receiver_address }}</p>

                        <strong>Ghi chú:</strong>
                        <p>{{ $order->notes }}</p>

                        <strong>Tổng tiền:</strong>
                        <p class="money">{{ $order->final_total }} VND</p>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
