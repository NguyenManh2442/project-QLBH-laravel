@extends('layout.layout_admin')
@section('title', 'Quản lý đơn hàng')
@section('content')
    @if (Session::has('reserve'))
        <div class="alert alert-success">{{ Session::get('reserve') }}</div>
    @endif
    @if (isset($order))
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Điện thoại</th>
                    <th scope="col">Nhận Đơn hàng</th>
                </tr>
            </thead>
            <tbody class="thongTinOrder">
                @foreach ($order as $key => $orders)
                    <tr>
                        <th scope="row">{{ $orders->orderID }}</th>
                        <td>{{ $orders->address }}</td>
                        <td>{{ $orders->fullName }}</td>
                        <td>{{ $orders->phone }}</td>
                        <td><a class="btn btn-facebook" href="reserve&orderId={{ $orders->orderID }}">Nhận đơn</a></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr id='btnLoadMore'>
                    <td scope="row">
                        @if (isset($shippers))
                            <button class="btn btn-info load-more" id="btnLoad1" data-id="{{ $orders->orderDate }}">Xem
                                thêm...</button>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <h1 style="text-align: center">Chưa có đơn hàng nào!</h1>
    @endif
@endsection
