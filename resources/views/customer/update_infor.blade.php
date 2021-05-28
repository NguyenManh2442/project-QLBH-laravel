@extends('layout.layout_customer')
@section('content')

@section('title')
    Infor
@endsection
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
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
                                Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill"
                                href="#account-vertical-password" aria-expanded="false">
                                <i class="feather icon-lock mr-50 font-medium-3"></i>
                                Thay đổi mật khẩu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill"
                                href="#account-vertical-info" aria-expanded="false">
                                <i class="feather icon-info mr-50 font-medium-3"></i>
                                Địa chỉ
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
                                        <form novalidate action="{{ route('updateInfor') }}" method="post"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img id="image" class="rounded mr-75 @if (empty(Auth::user()->avatar)) hidden @endif"
                                                        src="{{ asset('img') }}/{{ isset(Auth::user()->avatar) ? Auth::user()->avatar : '' }}"
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
                                                            <label for="account-username">Username</label>
                                                            <input type="text" class="form-control @error('username') border border-danger @enderror"
                                                                id="account-username" placeholder="Username"
                                                                name="username" value="{{ Auth::user()->username }}">
                                                            @error('username')
                                                                <lable style="color: red">{{ $errors->first('username') }}</lable>
                                                                <br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">Name</label>
                                                            <input type="text" class="form-control @error('full_name') border border-danger @enderror" id="account-name"
                                                                placeholder="Name" name="full_name"
                                                                value="{{ Auth::user()->full_name }}">
                                                            @error('full_name')
                                                                <lable style="color: red">{{ $errors->first('full_name') }}</lable>
                                                                <br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">Birth day</label>
                                                            <input type="date" class="form-control @error('birth_date') border border-danger @enderror" name="birth_date"
                                                                value="{{ Auth::user()->birth_date }}">
                                                            @error('birth_date')
                                                                <lable style="color: red">{{ $errors->first('birth_date') }}</lable>
                                                                <br><br>
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
                                        <form novalidate action="{{ route('changePassword') }}" method="POST">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-old-password">Old Password</label>
                                                            <input type="password" class="form-control @error('old_password') border border-danger @enderror"
                                                                id="account-old-password" placeholder="Old Password"
                                                                name="old_password">
                                                            @error('old_password')
                                                                <lable style="color: red">{{ $errors->first('old_password') }}</lable>
                                                                <br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-new-password">New Password</label>
                                                            <input type="password" id="account-new-password"
                                                                class="form-control @error('new_password') border border-danger @enderror" placeholder="New Password"
                                                                name="new_password">
                                                            @error('new_password')
                                                                <lable style="color: red">{{ $errors->first('new_password') }}</lable>
                                                                <br><br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-retype-new-password">Retype New
                                                                Password</label>
                                                            <input type="password" class="form-control @error('confirm_password') border border-danger @enderror"
                                                                id="account-retype-new-password"
                                                                placeholder="New Password" name="confirm_password">
                                                            @error('confirm_password')
                                                                <lable style="color: red">{{ $errors->first('confirm_password') }}</lable>
                                                                <br><br>
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
                                    <div class="tab-pane fade " id="account-vertical-info" role="tabpanel"
                                        aria-labelledby="account-pill-password" aria-expanded="false">
                                        <div style="text-align: right; margin-top: 20px">
                                            <a href="/createAddress" class="btn bg-gradient-success mr-1 mb-1"><i
                                                    class="feather icon-plus-square"></i> Add address</a>
                                        </div>
                                        <table class="table data-thumb-view" id="table_data_address">
                                            <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tbody>
                                                @if ($address != null)
                                                    @foreach ($address as $key => $value)
                                                        <tr id="data-{{ $value->id }}">
                                                            <td class="address-name" target="name">{{ $value->name }}
                                                            </td>
                                                            <td class="address-phone" target="phone">
                                                                {{ $value->phone_number }}</td>
                                                            <td class="address-detailed-address"
                                                                target="detailed-address">
                                                                {{ $value->detailed_address }} -
                                                                {{ $value->wards }} - {{ $value->district }} -
                                                                {{ $value->province }}</td>
                                                            <td class="product-action">
                                                                <a href="/editAddress&id={{ $value->id }}"><i
                                                                        class="feather icon-edit"></i></a>
                                                                <span class="action-delete" data-toggle="modal"
                                                                    data-target="#danger{{ $value->id }}"><i
                                                                        class="feather icon-trash"></i></span>
                                                                {{-- Model fake --}}
                                                                <div class="modal fade text-left"
                                                                    id="editFake{{ $value->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="myModalLabel120"
                                                                    aria-hidden="true">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <form action=""></form>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- Modal delete-->
                                                                <div class="modal fade text-left"
                                                                    id="danger{{ $value->id }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="myModalLabel120"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-danger white">
                                                                                <h5 class="modal-title"
                                                                                    id="myModalLabel120">
                                                                                    Cảnh báo
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Bạn có chắc muốn xóa address này?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form
                                                                                    action="{{ route('address.detete', $value->id) }}"
                                                                                    method="post">
                                                                                    @method('delete')
                                                                                    <input class="btn btn-danger"
                                                                                        type="submit" value="Delete" />
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <h2>Bạn chưa có địa chỉ nào<h2 @endif
                                            </tbody>
                                        </table>
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
