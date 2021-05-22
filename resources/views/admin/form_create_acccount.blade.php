@extends('layout.layout_admin')
@section('title', 'Quản lý tài khoản')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($employee))
                        <h4 class="card-title">Update tài khoản</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('update_acc_admin', $employee->id) }}" method="post"
                            class="form form-horizontal">
                            @method('PUT')
                        @else
                            <h4 class="card-title">Thêm mới tài khoản</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/createAccAdmin" method="post" class="form form-horizontal">
                                @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Email</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('mail_address') border border-danger @enderror"
                                                        name="mail_address" placeholder="Email"
                                                        value="{{ old('mail_address', $employee->mail_address ?? null) }}">
                                                    @error('mail_address')
                                                        <lable style="color: red">{{ $errors->first('mail_address') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Name</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('name') border border-danger @enderror"
                                                        name="name" placeholder="name"
                                                        value="{{ old('name', $employee->name ?? null) }}">
                                                    @error('name')
                                                        <lable style="color: red">{{ $errors->first('name') }}</lable><br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Address</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('address') border border-danger @enderror"
                                                        name="address" placeholder="Address"
                                                        value="{{ old('address', $employee->address ?? null) }}">
                                                    @error('address')
                                                        <lable style="color: red">{{ $errors->first('address') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Phone</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number"
                                                        class="form-control @error('phone') border border-danger @enderror"
                                                        name="phone" placeholder="Phone"
                                                        value="{{ old('phone', $employee->phone ?? null) }}">
                                                    @error('phone')
                                                        <lable style="color: red">{{ $errors->first('phone') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Date of birth</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date"
                                                        class="form-control @error('birth_date') border border-danger @enderror"
                                                        name="birth_date"
                                                        value="{{ old('birth_date', $employee->birth_date ?? null) }}">
                                                    @error('birth_date')
                                                        <lable style="color: red">{{ $errors->first('birth_date') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Role</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <select class="form-control" name="role">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Employee</option>
                                                            <option value="3">Shipper</option>
                                                        </select>
                                                        @error('role')
                                                            <lable style="color: red">{{ $errors->first('role') }}</lable>
                                                            <br><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Password</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="password"
                                                        class="form-control @error('password') border border-danger @enderror"
                                                        name="password" placeholder="Password">
                                                    @error('password')
                                                        <lable style="color: red">{{ $errors->first('password') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Confirm password</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') border border-danger @enderror"
                                                        name="password_confirmation" placeholder="Confirm password">
                                                    @error('password_confirmation')
                                                        <lable style="color: red">
                                                            {{ $errors->first('password_confirmation') }}</lable><br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                            <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                                value="{{ !isset($employee) ? 'Thêm mới' : 'Cập nhật' }}">
                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> </div>
        </div>
    @endsection
    @section('scripts')
        <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
        <script src="{{ asset('css/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    @stop
