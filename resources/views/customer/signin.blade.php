@extends('layout.template_user')
@section('title','Đăng nhập')
@section('noidung')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-4 dangnhap">
        <form action="/post-signin" method="post" onsubmit="return ValidateForm2();">
            <div><h3>ĐĂNG NHẬP TÀI KHOẢN</h3></div><br>
            <label>Nếu bạn đã có tài khoản, vui lòng đăng nhập:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
            <span class="error text-danger" id="error_birth">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </span><br>
            <input type="password" class="form-control" name="password" id="pass" placeholder="Mật khẩu">
            <span class="error text-danger" id="error_birth">
                @if($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
            </span><br>
            <input type="submit" name="signin" id="" class="btn btn-info" value="Đăng nhập"><br><br>
            <!-- ĐĂNG NHẬP VỚI FACEBOOK---------------------------- -->

               <!-- END ĐĂNG NHẬP VỚI FACEBOOK---------------------------- -->

            <!-- <a href=""><img src="" alt='facebook login' title="Facebook Login" height="50" width="250"/></a><br><br> -->
            <a href="/signup">Bạn chưa có tài khoản? Đăng ký tại đây!</a><br><br>
            <a href="/forget-password">Bạn quên mật khẩu?</a>
        </form>
    </div>
    <div class="col-md-4 text-dangkyTv">
        <div><h3>ĐĂNG KÝ THÀNH VIÊN</h3></div><br>
        <div><label> Những lợi ích khi đăng ký thành viên:</label></div>
        <div><i class="far fa-check-square"></i> Quản lý và kiểm tra trạng thái đơn hàng thật dễ dàng</div><br>
        <div><i class="far fa-check-square"></i> Quản lý điểm thẻ tích lũy khi mua hàng</div><br>
        <div><i class="far fa-check-square"></i> Quản lý những sản phẩm yêu thích đã lưu lại</div><br>
        <div> Còn chờ gì nữa! Bạn hãy tạo ngay 1 tài khoản dễ dàng chỉ trong vài phút</div><br>
        <a href="/signup" class="btn btn-danger" >Đăng ký ngay</a>
    </div>
    <div class="col-md-2">

    </div>
</div>
<script src="{{asset('bootstrap/font_end/signin.bootstrap')}}"></script>
@endsection
