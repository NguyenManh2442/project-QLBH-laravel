@extends('layout.template_user')
@section('title','Thông tin cá nhân')
@section('noidung')

<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4 suatt">
        <form action="update_infor" method="post" onsubmit="return ValidateForm(); ">
            <div><h3>HỒ SƠ CỦA : {{Auth::user()->username}} </h3></div><br>
            <label>Quản lý thông tin hồ sơ để bảo mật tài khoản</label><br><br>
            <!-- ----------------------------------------------------------- -->
            @if(Session::has('update-infor'))
                <div class="alert alert-success">{{Session::get('update-infor')}}</div>
            @endif
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
            <input type="submit" name="btnLuu" id="" class="btn btn-info" value="Lưu"><br><br>
        </form>
    </div>
    <div class="col-md-4">

    </div>
</div>
@endsection

