@extends('layout.template_user')
@section('title','Lấy lại mật khẩu')
@section('noidung')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4 dangky">
            <form action="/message/send" method="post" onsubmit="return ValidateForm(); ">
                <div><h3>LẤY LẠI MẬT KHẨU</h3></div><br>
                @if(Session::has('danger'))
                    <div class="alert alert-success">{{Session::get('danger')}}</div>
                @endif
                @if(Session::has('sendEmail'))
                    <div class="alert alert-success">{{Session::get('sendEmail')}}</div>
                @endif
                <label>Vui lòng nhập địa chỉ Email để lấy lại mật khẩu</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Địa chỉ e-mail">
                <span class="error text-danger" id="error_birth">
                    @if($errors->has('email'))
                            {{ $errors->first('email') }}
                    @endif
                </span><br>
                <input type="submit" name="signup" id="" class="btn btn-info" value="Xác nhận"><br><br>
            </form>
        </div>
        <div class="col-md-4 text-dangkyTv">

        </div>
        <div class="col-md-2">

        </div>
    </div>
    <script src="{{asset('bootstrap/font_end/signup.bootstrap')}}"></script>
@endsection
