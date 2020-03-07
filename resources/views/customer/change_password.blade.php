@extends('layout.template_user')
@section('title','Thay đổi mật khẩu')
@section('noidung')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4 dangky">
            <form action="/post-change-password" method="post" onsubmit="return ValidateForm(); ">
                <div><h3>THAY ĐỔI PASSWORD</h3></div><br>
                @if(Session::has('thaymatkhau'))
                    <div class="alert alert-danger">{{Session::get('thaymatkhau')}}</div>
                @endif
                @if(Session::has('thaymatkhau2'))
                    <div class="alert alert-success">{{Session::get('thaymatkhau2')}}</div>
                @endif
                <label>Thông tin cần nhập</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu cũ">
                <span class="error text-danger" id="error_birth">
                @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </span><br>
                <div class="row">
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="newPassword1" id="pass1" placeholder="Mật khẩu mới">
                        <span class="error text-danger" id="error_birth">
                            @if($errors->has('newPassword1'))
                                    {{ $errors->first('newPassword1') }}
                            @endif
                        </span><br>
                    </div>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="newPassword2" id="pass2" placeholder="Nhập lại mật khẩu mới"><br>
                        <span class="error text-danger" id="error_birth">
                            @if($errors->has('newPassword2'))
                                {{ $errors->first('newPassword2') }}
                            @endif
                        </span><br>
                    </div>
                </div>
                <input type="submit" name="signup" id="" class="btn btn-info" value="Thay đổi"><br><br>
            </form>
        </div>
        <div class="col-md-4 text-dangkyTv">

        </div>
        <div class="col-md-2">

        </div>
    </div>
    <script src="{{asset('bootstrap/font_end/signup.bootstrap')}}"></script>
@endsection
