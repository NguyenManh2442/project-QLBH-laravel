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
                    data: [{{ $count[0] }}, {{ $count[1] }}, {{ $count[2] }},
                        {{ $count[3] }}, {{ $count[4] }}, {{ $count[5] }},
                        {{ $count[6] }}, {{ $count[7] }}, {{ $count[8] }},
                        {{ $count[9] }}, {{ $count[10] }}, {{ $count[11] }}
                    ],
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
