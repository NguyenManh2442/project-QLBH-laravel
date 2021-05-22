@extends('layout.layout_admin')
@section('title', 'Chart')
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Biểu đồ</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="line-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <section id="statistics-card">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            @if ($sellingProducts->count() >= 5)
                                <h3 class="text-bold-700 mb-0">Top 5 sản phẩm bán chạy</h3><br>
                            @else
                                <h3 class="text-bold-700 mb-0">Top {{ $sellingProducts->count() }} sản phẩm bán chạy</h3>
                                <br>
                            @endif
                            @foreach ($sellingProducts as $key => $value)
                                <p>{{ $key + 1 }}. {{ $value->product_name }}, Tổng số lượng: {{ $value->selling }}
                                </p>
                            @endforeach
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-primary font-medium-5"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            @if ($sellingProductsByYear->count() >= 5)
                                <h3 class="text-bold-700 mb-0">Top 5 sản phẩm bán chạy năm
                                    {{ Illuminate\Support\Carbon::now()->format('Y') }}</h3><br>
                            @else
                                <h3 class="text-bold-700 mb-0">Top {{ $sellingProductsByYear->count() }} sản phẩm bán chạy
                                    năm {{ Illuminate\Support\Carbon::now()->format('Y') }}</h3><br>
                            @endif
                            @foreach ($sellingProductsByYear as $key => $value)
                                <p>{{ $key + 1 }}. {{ $value->product_name }}, Tổng số lượng: {{ $value->selling }}
                                </p>
                            @endforeach
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-primary font-medium-5"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            @if ($sellingProductsByMonth->count() >= 5)
                                <h3 class="text-bold-700 mb-0">Top 5 sản phẩm bán chạy tháng
                                    {{ Illuminate\Support\Carbon::now()->format('m') }}</h3><br>
                            @else
                                <h3 class="text-bold-700 mb-0">Top {{ $sellingProductsByMonth->count() }} sản phẩm bán
                                    chạy tháng {{ Illuminate\Support\Carbon::now()->format('m') }}</h3><br>
                            @endif
                            @foreach ($sellingProductsByMonth as $key => $value)
                                <p>{{ $key + 1 }}. {{ $value->product_name }}, Tổng số lượng:
                                    {{ $value->selling }}</p>
                            @endforeach
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-primary font-medium-5"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-eye text-info font-medium-5"></i>
                                </div>
                            </div>
                            <h3 class="text-bold-700">{{ $ordersPendingApproval->count() }}</h3>
                            <p class="mb-0 line-ellipsis">Đơn hàng chờ duyệt</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-message-square text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h3 class="text-bold-700">{{ $ordersApproved->count() }}</h3>
                            <p class="mb-0 line-ellipsis">Đơn hàng đã duyệt</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-shopping-bag text-danger font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700">{{ $ordersShipping->count() }}</h2>
                            <p class="mb-0 line-ellipsis">Đơn hàng đang ship</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/charts/apexcharts.css') }}">
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            var $primary = '#7367F0',
                $success = '#28C76F',
                $danger = '#EA5455',
                $warning = '#FF9F43',
                $info = '#00cfe8',
                $label_color_light = '#dae1e7';

            var themeColors = [$primary, $success, $danger, $warning, $info];

            // RTL Support
            var yaxis_opposite = false;
            if ($('html').data('textdirection') == 'rtl') {
                yaxis_opposite = true;
            }
            var d = new Date();
            var n = d.getMonth();
            var arr = new Array({{ $count[0] }}, {{ $count[1] }}, {{ $count[2] }},
                {{ $count[3] }}, {{ $count[4] }}, {{ $count[5] }},
                {{ $count[6] }}, {{ $count[7] }}, {{ $count[8] }},
                {{ $count[9] }}, {{ $count[10] }}, {{ $count[11] }});
            var dataWithMonth = arr.slice(0, n + 1);
            // Line Chart
            // ----------------------------------
            var lineChartOptions = {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                colors: themeColors,
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                series: [{
                    name: "Sản phẩm",
                    data: dataWithMonth,
                }],
                title: {
                    text: 'Số lượng sản phẩm bán theo tháng của năm 2021',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                },
                yaxis: {
                    tickAmount: 5,
                    opposite: yaxis_opposite
                }
            }
            var lineChart = new ApexCharts(
                document.querySelector("#line-chart"),
                lineChartOptions
            );
            lineChart.render();
        });

    </script>
    <script src="{{ asset('css/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
@stop
