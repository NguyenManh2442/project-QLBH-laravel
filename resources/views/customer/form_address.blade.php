@extends('layout.layout_customer')
@section('title','Thêm địa chỉ')
@section('content')
<div class="row" >
    <div class="col-md-3"></div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header"> 
                <h4 class="card-title">Thêm mới địa chỉ</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('address.store')}}" method="post" class="form form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Họ tên</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" value="{{ old('name', $voucher->name ?? null) }}">
                                            @error('name')
                                                <lable style="color: red">{{ $errors->first('name') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Số điện thoại</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control @error('phone_number') border border-danger @enderror" name="phone_number" value="{{ old('phone_number', $voucher->phone_number ?? null) }}">
                                            @error('phone_number')
                                                <lable style="color: red">{{ $errors->first('phone_number') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Xã, phường</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('wards') border border-danger @enderror" name="wards" value="{{ old('wards', $voucher->wards ?? null) }}">
                                            @error('wards')
                                                <lable style="color: red">{{ $errors->first('wards') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Huyện, quận</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('district') border border-danger @enderror" name="district"  value="{{ old('district', $voucher->effective_date ?? null) }}">
                                            @error('district')
                                                <lable style="color: red">{{ $errors->first('district') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Tỉnh, thành phố</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('province') border border-danger @enderror" name="province"  value="{{ old('province', $voucher->expiration_date ?? null) }}">
                                            @error('province')
                                                <lable style="color: red">{{ $errors->first('province') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Thôn, ngõ, số nhà</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('detailed_address') border border-danger @enderror" name="detailed_address"  value="{{ old('detailed_address', $voucher->expiration_date ?? null) }}">
                                            @error('detailed_address')
                                                <lable style="color: red">{{ $errors->first('detailed_address') }}</lable><br><br>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 offset-md-4">
                                    <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add" value="Thêm mới">
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