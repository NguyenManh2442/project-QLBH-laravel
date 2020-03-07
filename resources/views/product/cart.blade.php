@extends('layout.template_user')
@section('title','Giỏ hàng')
@section('noidung')

<div class=" cart-header">
    <div class="cart-name"><h1>| Giỏ Hàng</h1> </div>
</div>
@php
    $tong=0;
    $sessionCart = session()->get('cart');
@endphp
@if (isset($sessionCart)&&Auth::check())
<div class="container" id="listCart" >
 <table class="table table-hover table-condensed" id="cartx" >
  <thead>
   <tr>
    <th style="width:50%">Tên sản phẩm</th>
    <th style="width:10%">Giá</th>
    <th style="width:8%">Số lượng</th>
    <th style="width:22%" class="text-center">Thành tiền</th>
    <th style="width:10%"> </th>
   </tr>
  </thead>
  <tbody>
          @foreach ($sessionCart as $key => $value)
    <tr>
       <td data-th="Product">
          <div class="row">
           <div class="col-sm-2 hidden-xs"><img src="{{asset('img')}}/{{$value['image']}}" alt="Sản phẩm 1"  width="100">
           </div>
           <div class="col-sm-10">
            <h4 class="nomargin">{{$value['name']}}</h4>
            <p>Quần</p>
           </div>
          </div>
       </td>
       <td data-th="Price">{{ number_format($value['gia'])}} .Đ</td>
         <td data-th="Quantity"><input class="form-control text-center" value="{{$value['num']}}" type="number" min="1" id="quantity_<?php echo $key; ?>" name="quantity_<?php echo $key; ?>" onchange="updateCart(<?php echo $key; ?>)" >
         </td>
        <td data-th="Subtotal" class="text-center">{{ number_format($tien = $value['gia']*$value['num']) }} Đ </td>
        <td class="actions" data-th="">
          <a href="javascript:void(0)" onclick="deleteCart({{ $key }})" class="btn btn-danger btn-sm"><i class="fa fa-trash-o">Xóa</i>

          </a>
       </td>
  </tr>
  @php
        $tong+=$tien;
  @endphp
       @endforeach



  </tbody>



  <tfoot>
   <tr>
        <td><a href="/trangchu" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
        </td>
        <td colspan="2" class="hidden-xs"> </td>
        <td class="hidden-xs text-center"><strong>Tổng :  {{ number_format($tong) }} Đ</strong>
        </td>

   </tr>
  </tfoot>
 </table>
</div>
{{----------------------------------QUẢN LÝ THÔNG TIN ĐẶT HÀNG-------------------------}}
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 suatt">
        @if(Session::has('loidathang'))
            <div class="alert alert-danger" style="text-align: center" >{{Session::get('loidathang')}}</div>
        @endif
        <form action="/dathang" method="post" onsubmit="return ValidateForm(); ">
            <div><h3 style="text-align: center">Quản lý thông tin đặt hàng</h3></div><br>
            <label >*Vui lòng cập nhật thông tin chính xác trước khi đặt hàng</label><br><br>
            <!-- ----------------------------------------------------------- -->
            <label>User name: </label><input type="text" class="form-control" name="username" id="username"  value="{{Auth::user()->username}}" >
            <span class="error text-danger" id="error_name">
                @if($errors->has('username'))
                    {{ $errors->first('username') }}
                @endif
            </span><br>

            <!-- ----------------------------------------------------------- -->
            <label>Họ và tên: </label><input type="text" class="form-control" name="fullName" id="fullName" placeholder="VD: Nguyễn Văn A" value="{{Auth::user()->fullName}}" >
            <span class="error text-danger" id="error_name">
                @if($errors->has('fullName'))
                    {{ $errors->first('fullName') }}
                @endif
            </span><br>
            <!-- ----------------------------------------------------------- -->
            <label>Số điện thoại: </label><input type="text" class="form-control" name="phone" id="phone" placeholder="VD: 0123456789" value="{{Auth::user()->phone}}">
            <span class="error text-danger" id="error_phone">
                @if($errors->has('phone'))
                    {{ $errors->first('phone') }}
                @endif
            </span><br>
            <!-- ----------------------------------------------------------- -->
            <label>Địa chỉ: </label><input type="text" class="form-control" name="address" id="address" placeholder="Số nhà - Xóm - Xã,Phường - Quận huyện - Tỉnh thành phố" value="{{Auth::user()->address}}">
            <span class="error text-danger" id="error_address">
                @if($errors->has('address'))
                    {{ $errors->first('address') }}
                @endif
            </span><br>
            <!-- ----------------------------------------------------------- -->
            <label>Ngày sinh: </label><input type="date" class="form-control" name="birthDate" id="birthDay" value="{{Auth::user()->birthDate}}">
            <span class="error text-danger" id="error_birth">
                @if($errors->has('birthDate'))
                    {{ $errors->first('birthDate') }}
                @endif
            </span><br>
            <!-- ----------------------------------------------------------- -->
            <strong>Tổng Tiền :  {{ number_format($tong) }} Đ</strong><br><br>
            <input type="submit" name="btnLuu" id="" class="btn btn-success btn-block" value="Thanh toán >>"><br><br>
        </form>
    </div>
</div>
<div class="col-md-4"></div>
@else
    <div class=" cart-header">
        <div class="cart-name"><h1>Không có sản phẩm nào trong giỏ hàng!</h1> </div><br><br><br><br><br>
        @if(Session::has('dathang'))
            <div class="alert alert-success" style="text-align: center" >{{Session::get('dathang')}}</div>
        @endif
    </div>
@endif
@endsection
