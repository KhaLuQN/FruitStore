<body>
    <div class="wrapper wrapper-content">
        <div style="margin-bottom: 20px" class="row ">
            <div class="col-lg-5">
                <form method="GET" action="{{ route('dashboard.index') }}">
                    @csrf
                    <div class="row d-flex ibox-title   ">
                        <div class="col-lg-4  float-e-margins ">
                            <label for="start_date"> Từ :</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                value="{{ old('start_date', $startDate ? $startDate->toDateString() : '') }}" required>
                        </div>
                        <div class="col-lg-4  float-e-margins">
                            <label for="end_date"> Đến :</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                value="{{ old('end_date', $endDate ? $endDate->toDateString() : '') }}" required>
                        </div>
                        <div class="col-lg-4   float-e-margins">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Monthly</span>
                        <h5>Doanh thu</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ number_format($revenue) }}</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Hôm nay</span>
                        <h5>Đơn hàng</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalOrders }}</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Low value</span>
                        <h5>Khách hàng mới</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $newUsers }}</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                        </div>
                        <small>In first month</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Thống kê đơn hàng </h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart">
                                    <div class="flot-dashboard-chart" id="flot-dashboard-chart" style="height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="flot-chart">
        <div class="flot-dashboard-chart" id="flot-dashboard-chart" style="height: 200px;"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            var data = [
                @foreach ($ordersByStatus as $status)
                    {
                        label: '{{ ucfirst($status->status) }}',
                        data: {{ $status->count }},
                        color: getStatusColor('{{ $status->status }}')
                    },
                @endforeach
            ];


            function getStatusColor(status) {
                switch (status) {
                    case 'pending':
                        return '#F39C12';
                    case 'processing':
                        return '#F1C40F';
                    case 'out_for_delivery':
                        return '#1ABC9C';
                    case 'completed':
                        return '#2ECC71';
                    case 'cancelled':
                        return '#E74C3C';
                    default:
                        return '#BDC3C7';
                }
            }


            $.plot('#flot-dashboard-chart', data, {
                series: {
                    pie: {
                        show: true,
                        innerRadius: 0.3,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' +
                                    Math.round(series.percent) + '%</div>';
                            }
                        }
                    }
                },
                legend: {
                    show: true
                }
            });
        });
    </script>



</body>
