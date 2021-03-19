@extends('layout.layout_customer')
@section('content')

@section('title')
Đơn hàng
@endsection
<div class="row">
    <div class="col-sm-12">
        <div class="card overflow-hidden">
            <div class="card-header">
                <h4 class="card-title">Quản lý đơn hàng</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 0 ? 'active' : ''}}" id="home-tab-fill" href="{{ route('order.ordered', 0) }}" role="tab" >Đơn hàng chờ duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 1 ? 'active' : ''}}" id="profile-tab-fill" href="{{ route('order.ordered', 1) }}" role="tab" >Đơn hàng đã duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 2 ? 'active' : ''}}" id="messages-tab-fill" href="{{ route('order.ordered', 2) }}" role="tab" >Đơn hàng đang ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 3 ? 'active' : ''}}" id="settings-tab-fill" href="{{ route('order.ordered', 3) }}" role="tab" >Đơn hàng đã ship</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1">
                        <div class="tab-pane active">
                            <div class="table-responsive">
                                <table class="table data-thumb-view">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Size</th>
                                            <th>Đơn giá</th>
                                            <th>Ngày đặt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $value)
                                            <tr>
                                                <td></td>
                                                <td class="product-img"><img
                                                        src="{{ asset('img') }}/{{ $value->image }}"
                                                        alt="Img placeholder" width="500px" height="300px">
                                                </td>
                                                <td>{{ $value->product_name }}</td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>{{ $value->size }}</td>
                                                <td>
                                                    {{ number_format($value->unit_price - $value->unit_price * ($value->discount / 100)) }} Đ
                                                </td>
                                                <td>{{ $value->order_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div >{!! $products->render(); !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection