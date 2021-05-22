@extends('layout.template_admin')
@section('title', 'Quản lý đơn hàng')
@section('noidung')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Điện thoại</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Chi tiết</th>
            </tr>
        </thead>
        <tbody class="thongTinOrder">
            @foreach ($order as $key => $orders)
                <tr>
                    <th scope="row">{{ $orders->orderID }}</th>
                    <td>{{ $orders->orderDate }}</td>
                    <td>{{ $orders->fullName }}</td>
                    <td>{{ $orders->phone }}</td>
                    <td>
                        @if ($orders->status == '')
                            <p style="color: red">Chưa xác nhận</p>
                        @elseif($orders->status==4)
                            <p style="color: red">Đã hủy</p>
                        @elseif($orders->status==2)
                            <p style="color:#000080">Shipper đã nhận</p>
                        @elseif($orders->status==3)
                            <p style="color: green">Đã giao thành công</p>
                        @else
                            <p style="color: #FFA500">Đã xác nhận</p>
                        @endif
                    </td>
                    <td><a href="orderdetail&orderId={{ $orders->orderID }}" class="btn btn-info">Xem chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr id='btnLoadMore'>
                <td scope="row">
                    <button class="btn btn-info load-more" id="btnLoad2" data-id="{{ $orders->orderDate }}">Xem
                        thêm...</button>
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
