@extends('layout.layout_shipper')
@section('title', 'Shipper')
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
    <script src="{{ asset('css/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
@stop
