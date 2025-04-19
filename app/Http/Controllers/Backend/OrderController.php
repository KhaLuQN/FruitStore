<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function getOrderCounts()
    {

        $outForDeliveryCount = Order::where('status', 'out_for_delivery')->count();
        $pendingCount = Order::where('status', 'pending')->count();
        $processingCount = Order::where('status', 'processing')->count();



        return [
            'outForDeliveryCount' => $outForDeliveryCount,
            'pendingCount' => $pendingCount,
            'processingCount' => $processingCount,

        ];
    }
    public function index()
    {
        $orderCounts = $this->getOrderCounts();
        $config = $this->config();

        // Sử dụng paginate cho từng trạng thái đơn hàng
        $outForDeliveryOrders = Order::where('status', 'out_for_delivery')->paginate(5, ['*'], 'outForDeliveryPage');
        $pendingOrders = Order::where('status', 'pending')->paginate(5, ['*'], 'pendingPage');
        $processingOrders = Order::where('status', 'processing')->paginate(5, ['*'], 'processingPage');
        $completedOrders = Order::where('status', 'completed')->paginate(5, ['*'], 'completedPage');
        $cancelledOrders = Order::where('status', 'cancelled')->paginate(5, ['*'], 'cancelledPage');

        $template = 'backend.manage_orders.index';
        return view(
            'backend.welcome',
            compact(
                'template',
                'config',
                'pendingOrders',
                'processingOrders',
                'outForDeliveryOrders',
                'completedOrders',
                'orderCounts',
                'cancelledOrders'
            )
        );
    }


    private function config()
    {
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'backend/js/inspinia.js',
                'backend/css/plugins/footable/footable.core.css',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'backend/js/plugins/footable/footable.all.min.js',

            ],

        ];
    }

    //  huỹ  đơn hàng
    public function cancelOrder($orderId)
    {

        $order = Order::find($orderId);

        if (!$order) {

            return redirect()->back()->with('error', 'Đơn hàng không tồn tại!');
        }


        $order->status = 'cancelled';
        $order->save();


        return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
    }





    public function changeStatus($orderId)
    {

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại!');
        }


        switch ($order->status) {
            case 'pending':
                $order->status = 'processing';
                $message = 'Đơn hàng đã được chấp nhận.';
                break;
            case 'processing':
                $order->status = 'out_for_delivery';
                $message = 'Đơn hàng đã được  vận chuyển.';
                break;
            case 'out_for_delivery':
                $order->status = 'completed';
                $message = 'Đơn hàng đã được hoàn thành.';
                if ($order->orderItems && $order->orderItems->count() > 0) {
                    foreach ($order->orderItems as $orderItem) {
                        $product = $orderItem->product;
                        $product->quantity -= $orderItem->quantity;
                        $product->sold_quantity += $orderItem->quantity;
                        $product->save();
                    }
                } else {
                    return redirect()->back()->with('error', 'Đơn hàng không có sản phẩm để giảm số lượng.');
                }
                break;
            default:
                return redirect()->back()->with('error', 'Trạng thái không hợp lệ để thay đổi!');
        }
        $order->save();
        return redirect()->back()->with('success', $message);
    }
}
