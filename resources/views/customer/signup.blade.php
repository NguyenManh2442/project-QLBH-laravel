@extends('layout.template_user')
@section('title','Đăng ký')
@section('noidung')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-4 dangky">
        <form action="/post-signup" method="post" onsubmit="return ValidateForm(); ">
            <div><h3>ĐĂNG KÝ TÀI KHOẢN</h3></div><br>
            @if(Session::has('thanhcong'))
                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
            @endif
            <label>Thông tin cần nhập</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Địa chỉ e-mail">
            <span class="error text-danger" id="error_email"></span><br>
            <input type="text" class="form-control" name="userName" id="userName" placeholder="Tên đăng nhập (8-16)">
            <span class="error text-danger" id="error_user"></span><br>
            <div class="row">
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password1" id="pass1" placeholder="Mật khẩu">
                    <span class="error text-danger" id="error_pass"></span><br>
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password2" id="pass2" placeholder="Nhập lại mật khẩu"><br>
                </div>
            </div>
            <input type="submit" name="signup" id="" class="btn btn-info" value="Đăng ký ngay"><br><br>

            <a href="/signin">Bạn đã có tài khoản? Đăng nhập tại đây!</a><br><br>
        </form>
    </div>
    <div class="col-md-4 text-dangkyTv">
        <div><h3>ĐĂNG KÝ THÀNH VIÊN</h3></div><br>
        <div><label> Những lợi ích khi đăng ký thành viên:</label></div>
        <div><i class="far fa-check-square"></i> Quản lý và kiểm tra trạng thái đơn hàng thật dễ dàng</div><br>
        <div><i class="far fa-check-square"></i> Quản lý điểm thẻ tích lũy khi mua hàng</div><br>
        <div><i class="far fa-check-square"></i> Quản lý những sản phẩm yêu thích đã lưu lại</div><br>
        <div> Còn chờ gì nữa! Bạn hãy tạo ngay 1 tài khoản dễ dàng chỉ trong vài phút!</div><br>
    </div>
    <div class="col-md-2">

    </div>
</div>
<script src="{{asset('bootstrap/font_end/signup.bootstrap')}}"></script>
@endsection
