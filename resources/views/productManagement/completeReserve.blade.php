@extends('layout.template_admin')
@section('title', 'Quản lý đơn hàng')
@section('noidung')
    @if (Session::has('complete'))
        <div class="alert alert-success">{{ Session::get('complete') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Điện thoại</th>
                <th scope="col">Ngày hoàn thành</th>
            </tr>
        </thead>
        <tbody class="thongTinOrder">
            @foreach ($shipper as $key => $shippers)
                <tr>
                    <th scope="row">{{ $shippers->orderID }}</th>
                    <td>{{ $shippers->address }}</td>
                    <td>{{ $shippers->fullName }}</td>
                    <td>{{ $shippers->phone }}</td>
                    <td>{{ $shippers->completeOrderDate }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr id='btnLoadMore'>
                <td scope="row">
                    @if (isset($shippers))
                        <button class="btn btn-info load-more" id="btnLoad3"
                            data-id="{{ $shippers->completeOrderDate }}">Xem thêm...</button>
                    @else
                        <h1>Bạn chưa hoàn thành đơn hàng nào!</h1>
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
