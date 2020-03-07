@extends('layout.template_user')
@section('title','Đơn hàng')
@section('noidung')

    <div class=" cart-header">
        <div class="cart-name"><h1>| Đơn hàng đã đặt</h1> </div>
    </div>
    @php
        $tong=0;
    @endphp
    @if (Auth::check())
        <div class="container" id="listCart" >
            <table class="table table-hover table-condensed" id="cartx" >
                <thead>
                <tr>
                    <th style="width:50%">Tên sản phẩm</th>
                    <th style="width:10%">Giá</th>
                    <th style="width:8%">Số lượng</th>
                    <th style="width:22%" class="text-center">Thành tiền</th>
                    <th style="width:10%">Trạng thái</th>
                </tr>
                </thead>
                <tbody>


                @foreach ($orderProduct as $key => $value)


                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="{{asset('img')}}/{{$value->image}}" alt="Sản phẩm 1"  width="100">
                                </div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{$value->productName}}</h4>
                                    <p>Quần</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{ number_format($value->unitPrice)}} .Đ</td>
                        <td data-th="Quantity"><p>{{$value->quantity}}</p>
                        </td>
                        <td data-th="Subtotal" class="text-center">{{ number_format($tien = $value->unitPrice*$value->quantity) }} Đ </td>
                        <td>@if($value->status=='')
                                <p style="color: red">Chưa xác nhận</p>
                            @elseif($value->status==4)
                                <p style="color: red">Đã hủy</p>
                            @elseif($value->status==2)
                                <p style="color:#000080">Shipper đã nhận</p>
                            @elseif($value->status==3)
                                <p style="color: green">Đã giao thành công</p>
                            @else
                                <p style="color: #FFA500">Đã xác nhận</p>
                            @endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
