@extends('layout.layout_shipper')
@section('content')
@section('title')
    Profile
@endsection
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper" style="margin-top: 0px;">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active"> Account Settings
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill"
                                href="#account-vertical-general" aria-expanded="true">
                                <i class="feather icon-globe mr-50 font-medium-3"></i>
                                General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill"
                                href="#account-vertical-password" aria-expanded="false">
                                <i class="feather icon-lock mr-50 font-medium-3"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                        aria-labelledby="account-pill-general" aria-expanded="true">
                                        <form novalidate action="{{ route('updateProfile') }}" method="post"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img id="image" class="rounded mr-75 @if (empty(Auth::guard('employee')->user()->avatar)) hidden @endif"
                                                        src="{{ asset('img') }}/{{ isset(Auth::guard('employee')->user()->avatar) ? Auth::guard('employee')->user()->avatar : '' }}"
                                                        height="64" width="64">
                                                    </a>
                                                    <div class="media-body mt-75">
                                                        <div
                                                            class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                            <label
                                                                class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                                for="account-upload">Upload new photo</label>
                                                            <input type="file" id="account-upload" name="avatar"
                                                                onchange="previewFile(this);" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr><br><br><br>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Name</label>
                                                            <input type="text"
                                                                class="form-control  @error('full_name') border border-danger @enderror"
                                                                id="account-name" placeholder="Name" name="full_name"
                                                                value="{{ Auth::guard('employee')->user()->name }}">
                                                            @error('full_name')
                                                                <lable style="color: red">
                                                                    {{ $errors->first('full_name') }}</lable><br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Address</label>
                                                            <input type="text"
                                                                class="form-control @error('address') border border-danger @enderror"
                                                                id="account-name" placeholder="Address" name="address"
                                                                value="{{ Auth::guard('employee')->user()->address }}">
                                                            @error('address')
                                                                <lable style="color: red">{{ $errors->first('address') }}
                                                                </lable><br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Phone</label>
                                                            <input type="number"
                                                                class="form-control @error('phone') border border-danger @enderror"
                                                                id="account-name" placeholder="Phone" name="phone"
                                                                value="{{ Auth::guard('employee')->user()->phone }}">
                                                            @error('phone')
                                                                <lable style="color: red">{{ $errors->first('phone') }}
                                                                </lable><br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">Birth day</label>
                                                            <input type="date"
                                                                class="form-control @error('birth_date') border border-danger @enderror"
                                                                name="birth_date"
                                                                value="{{ Auth::guard('employee')->user()->birth_date }}">
                                                            @error('birth_date')
                                                                <lable style="color: red">
                                                                    {{ $errors->first('birth_date') }}</lable><br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                        aria-labelledby="account-pill-password" aria-expanded="false">
                                        <form novalidate action="{{ route('updatePassword') }}" method="POST">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-old-password">Old Password</label>
                                                            <input type="password" class="form-control"
                                                                id="account-old-password" placeholder="Old Password"
                                                                name="old_password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-new-password">New Password</label>
                                                            <input type="password" id="account-new-password"
                                                                class="form-control" placeholder="New Password"
                                                                name="new_password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-retype-new-password">Retype New
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                id="account-retype-new-password"
                                                                placeholder="New Password" name="confirm_password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->

    </div>
</div>
@endsection
@section('scripts')
<script>
    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                $("#image").attr("src", reader.result);
                if ($("#image").hasClass('hidden')) {
                    $("#image").removeClass('hidden')
                }
            }
            reader.readAsDataURL(file);
        }
    }

</script>
@stop
