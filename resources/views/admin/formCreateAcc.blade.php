@extends('layout.template_admin')
@section('title','Quản lý tài khoản')
@section('noidung')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4 dangky">
            <form action="/createAccAdmin" method="post" onsubmit="return ValidateForm(); ">
                <div><h3>ĐĂNG KÝ TÀI KHOẢN ADMIN</h3></div><br>
                @if(Session::has('addAcc'))
                    <div class="alert alert-success">{{Session::get('addAcc')}}</div>
                @endif
                <label>Thông tin cần nhập</label><br>
                <label>Nhập Email:</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Địa chỉ e-mail"><br>
                <label>Nhập họ và tên:</label>
                <input type="text" class="form-control" name="fullName" id="userName" placeholder="VD: Nguyen Van A"><br>
                <label>Nhập số điện thoại:</label>
                <input type="text" class="form-control" name="phone" id="phone" ><br>
                <label>Mật khẩu:</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password1" id="pass1" placeholder="Mật khẩu">
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password2" id="pass2" placeholder="Nhập lại mật khẩu"><br>
                    </div>
                </div>
                <select name="level" id="levelAcc" class="form-control">
                    <option value="0" >Chức vụ</option>
                    <option value="1" >Admin</option>
                    <option value="2" >Nhân viên</option>
                    <option value="3" >Shipper</option>
                </select><br>
                <input type="submit" name="signup" id="" class="btn btn-info" value="Đăng ký ngay"><br><br>

                <a href="/signin">Bạn đã có tài khoản? Đăng nhập tại đây!</a><br><br>
            </form>
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-4 text-dangkyTv">
            <div><h3>QUYỀN LỢI CỦA TỪNG TÀI KHOẢN</h3></div><br>
            <div><label style="color: #2e59d9; font-size: 20px;"> Với chức vụ Admin:</label></div>
            <div><i class="far fa-check-square"></i> Quản lý và kiểm tra đơn hàng</div><br>
            <div><i class="far fa-check-square"></i> Quản lý và kiểm tra kho hàng và sản phẩm</div><br>
            <div><i class="far fa-check-square"></i> Quản lý giao diện của website</div><br>
            <div><i class="far fa-check-square"></i> Quản lý thông tin tài khoản</div><br>
            <div><label style="color: #2e59d9; font-size: 20px;"> Với chức vụ Nhân viên:</label></div>
            <div><i class="far fa-check-square"></i> Quản lý và kiểm tra đơn hàng</div><br>
            <div><i class="far fa-check-square"></i> Quản lý và kiểm tra kho hàng và sản phẩm</div><br>
            <div><label style="color: #2e59d9; font-size: 20px;"> Với chức vụ Shipper:</label></div>
            <div><i class="far fa-check-square"></i> Quản lý đơn hàng đã nhận và đã giao</div><br>
        </div>
        <div class="col-md-1">

        </div>
    </div>

@endsection
