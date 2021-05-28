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
                            <a class="nav-link {{ $status == 0 ? 'active' : '' }}" id="home-tab-fill"
                                href="{{ route('order.ordered', 0) }}" role="tab">Đơn hàng chờ duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 1 ? 'active' : '' }}" id="profile-tab-fill"
                                href="{{ route('order.ordered', 1) }}" role="tab">Đơn hàng đã duyệt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 2 ? 'active' : '' }}" id="messages-tab-fill"
                                href="{{ route('order.ordered', 2) }}" role="tab">Đơn hàng đang ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 3 ? 'active' : '' }}" id="settings-tab-fill"
                                href="{{ route('order.ordered', 3) }}" role="tab">Đơn hàng đã ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 4 ? 'active' : '' }}" id="settings-tab-fill"
                                href="{{ route('order.ordered', 4) }}" role="tab">Đơn hàng đã hủy</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-1">
                        <div class="tab-pane active">
                            <div class="table-responsive">
                                @foreach ($orders as $key => $order)
                                    <div class="card border-primary text-center bg-transparent">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div style="text-align: left; margin: 10px">
                                                        <div class="detail">
                                                            <i class="fa fa-user"></i> {{ $order->name }}
                                                        </div><br>
                                                        <div class="detail">
                                                            <i class="fa fa-phone-square"></i>
                                                            {{ $order->phone_number }}
                                                        </div><br>
                                                        <div class="detail">
                                                            <i class="fa fa-address-card-o"></i>
                                                            {{ $order->detailed_address }} - {{ $order->wards }} -
                                                            {{ $order->district }} - {{ $order->province }}
                                                        </div><br>
                                                        <div class="detail">
                                                            Ngày đặt: {{ $order->order_date }}
                                                        </div><br>
                                                        <div class="detail">
                                                            Tổng tiền: {{ number_format($order->total_money) }}
                                                            Đ
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <table class="table data-thumb-view">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Size</th>
                                                                <th>Đơn giá</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $key => $value)
                                                                @if ($order->id == $value->order_id)
                                                                    <tr>
                                                                        <td class="product-img"><img
                                                                                src="{{ asset('img') }}/{{ $value->image }}"
                                                                                alt="Img placeholder" width="150px"
                                                                                height="150px">
                                                                        </td>
                                                                        <td>{{ $value->product_name }}</td>
                                                                        <td>{{ $value->quantity }}</td>
                                                                        <td>{{ $value->size }}</td>
                                                                        <td>
                                                                            {{ number_format($value->unit_price - $value->unit_price * ($value->discount / 100)) }}
                                                                            Đ
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div style="margin: 10px">
                                                        @if ($status == 4 || $status == 3)
                                                            <form
                                                                action="{{ route('order.status_cancel', $order->id) }}"
                                                                method="post">
                                                                @method('PUT')
                                                                <input type="submit" name="btn_reorder"
                                                                    class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light"
                                                                    value="Đặt lại" />
                                                            </form>
                                                        @elseif ($status == 0)
                                                            <form
                                                                action="{{ route('order.status_cancel', $order->id) }}"
                                                                method="post">
                                                                @method('PUT')
                                                                <input type="submit" name="btn_cancel"
                                                                    class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                    value="Hủy" />
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
