@extends('layout.template_admin')
@section('title', 'Quản lý đơn hàng')
@section('noidung')
    <div>
        <h1>Thông tin đơn hàng</h1><br>
        @foreach ($ord as $key => $user)
        @endforeach
        <h3>Họ tên khách hàng: {{ $user->fullName }}</h3>
        <h3>Email: {{ $user->email }}</h3>
        <h3>Số điện thoại: {{ $user->phone }}</h3>
        <h3>Địa chỉ giao hàng: {{ $user->address }}</h3><br><br>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá tiền</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tong = 0;
                $ord_arr = [];
            @endphp
            @foreach ($ord as $key => $value)
                <tr>
                    <th scope="row"><img src="{{ asset('img') }}/{{ $value->image }}" alt="Sản phẩm 1" width="100"></th>
                    <td>{{ $value->productName }}</td>
                    <td>{{ $value->unitPrice }} .Đ</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $tien = $value->unitPrice * $value->quantity }} .Đ</td>
                </tr>
                @php
                    $tong += $tien;
                @endphp
            @endforeach
        </tbody>

    </table>
    <div style="text-align: center">
        <h4>Tổng tiền của đơn hàng là: {{ $tong }} .VND</h4>
        <h4>Trạng thái:
            @if ($value->status == '')
                <p style="color: red">Chưa xác nhận</p>
            @elseif($value->status==4)
                <p style="color: red">Đã hủy</p>
            @else
                <p style="color: green">Đã xác nhận</p>
            @endif
        </h4>
        @if ($value->status == '')
            <form action="/orderConfirmation" method="post">
                <input type="hidden" name="orderID" value="{{ $user->orderID }}">
                <input type="submit" class="btn btn-info btn-sm" value="Xác nhận đơn hàng">
            </form><br>
            <form action="/orderCancel" method="post">
                <input type="hidden" name="orderID" value="{{ $user->orderID }}">
                <input type="submit" class="btn btn-danger btn-sm" value="Hủy">
            </form>
        @elseif($value->status==1)
            <div class="alert alert-success" style="text-align: center">Đã xác nhận</div>
        @elseif($value->status==2)
            <div class="alert alert-success" style="text-align: center">Shipper đã nhận</div>
        @elseif($value->status==3)
            <div class="alert alert-success" style="text-align: center">Đã giao thành công</div>
        @elseif($value->status==4)
            <div class="alert alert-danger" style="text-align: center">Đơn hàng đã hủy!</div>
        @endif
    </div>
@endsection
