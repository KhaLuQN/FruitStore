<div class="col-lg-8">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li>
                <a data-toggle="tab" href="#tab-1">
                    Chờ xác nhận
                    <span class="label label-danger">{{ $orderCounts['pendingCount'] }}</span>
                </a>
            </li>

            <li class=""><a data-toggle="tab" href="#tab-2">Đã xác nhận <span
                        class="label label-danger">{{ $orderCounts['processingCount'] }}</span></a></li>
            <li class=""><a data-toggle="tab" href="#tab-3">Đang giao <span
                        class="label label-danger">{{ $orderCounts['outForDeliveryCount'] }}</span> </a>
            </li>
            <li class=""><a data-toggle="tab" href="#tab-4">Hoàn tất</a></li>
            <li class=""><a data-toggle="tab" href="#tab-5">Đơn huỷ</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    @include('backend.manage_orders.component.pending_orders')
                    <div style="display: flex; justify-content: center;">
                        {{ $pendingOrders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}


                    </div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    @include('backend.manage_orders.component.processing_orders')
                    <div style="display: flex; justify-content: center;">
                        {{ $processingOrders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}


                    </div>
                </div>
            </div>
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    @include('backend.manage_orders.component.delivery_orders')

                    <div style="display: flex; justify-content: center;">
                        {{ $outForDeliveryOrders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}


                    </div>
                </div>
            </div>
            <div id="tab-4" class="tab-pane">
                <div class="panel-body">
                    @include('backend.manage_orders.component.completed_orders')
                    <div style="display: flex; justify-content: center;">
                        {{ $completedOrders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            <div id="tab-5" class="tab-pane">
                <div class="panel-body">

                    @include('backend.manage_orders.component.cancel_orders')
                    <div style="display: flex; justify-content: center;">
                        {{ $cancelledOrders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>

</div>


</div>
</div>
<script>
    $(document).ready(function() {

        $('.nav-tabs a').on('click', function(e) {
            const tabId = $(this).attr('href');
            localStorage.setItem('activeTab', tabId);
        });

        const activeTab = localStorage.getItem('activeTab');
        if (activeTab) {

            $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
        } else {

            $('.nav-tabs a:first').tab('show');
        }
    });
</script>
