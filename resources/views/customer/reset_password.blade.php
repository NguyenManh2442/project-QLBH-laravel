@extends('layout.template_user')
@section('title','Reset password')
@section('noidung')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4 dangnhap">
            <form action="/post-reset-password" method="post" onsubmit="return ValidateForm2();">
                    <div><h3>RESET PASSWORD</h3></div><br>
                <label>Vui lòng nhập đủ thông tin</label>
                @if(Session::has('resetPassword'))
                    <div class="alert alert-success">{{Session::get('resetPassword')}} Vui lòng đăng nhập<a href="/signin"> tại đây</a></div>
                @endif
                <input type="hidden" name="token" value="{{$token}}">
                <input type="hidden" name="email" value="{{$email}}">
                <input type="password" class="form-control" name="newPassword1" id="pass1" placeholder="Mật khẩu mới">
                <span class="error text-danger" id="error_birth">
                    @if($errors->has('newPassword1'))
                            {{ $errors->first('newPassword1') }}
                    @endif
                </span><br>
                <input type="password" class="form-control" name="newPassword2" id="pass2" placeholder="Nhập lại mật khẩu mới">
                <span class="error text-danger" id="error_birth">
                    @if($errors->has('newPassword2'))
                        {{ $errors->first('newPassword2') }}
                    @endif
                </span><br>
                <input type="submit" name="" id="" class="btn btn-info" value="Xác nhận"><br><br>
                <!-- ĐĂNG NHẬP VỚI FACEBOOK---------------------------- -->

                <!-- END ĐĂNG NHẬP VỚI FACEBOOK---------------------------- -->

                <!-- <a href=""><img src="" alt='facebook login' title="Facebook Login" height="50" width="250"/></a><br><br> -->
            </form>
        </div>
        <div class="col-md-4 text-dangkyTv">

        </div>
        <div class="col-md-2">

        </div>
    </div>
    <script src="{{asset('bootstrap/font_end/signin.bootstrap')}}"></script>
@endsection
