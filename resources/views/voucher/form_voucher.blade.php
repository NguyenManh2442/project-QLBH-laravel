@extends('layout.layout_admin')
@section('title', 'Quản lý vouchers')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($voucher))
                        <h4 class="card-title">Update voucher</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('vouchers.update', $voucher->id) }}" method="post"
                            enctype="multipart/form-data" class="form form-horizontal">
                            @method('PUT')
                        @else
                            <h4 class="card-title">Thêm mới voucher</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('vouchers.store') }}" method="post" class="form form-horizontal">
                                @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Name voucher</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('name_voucher') border border-danger @enderror"
                                                        name="name_voucher" placeholder="Name voucher"
                                                        value="{{ old('name_voucher', $voucher->name ?? null) }}">
                                                    @error('name_voucher')
                                                        <lable style="color: red">{{ $errors->first('name_voucher') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Quantity</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number"
                                                        class="form-control @error('quantity') border border-danger @enderror"
                                                        name="quantity" placeholder="Quantity"
                                                        value="{{ old('quantity', $voucher->quantity ?? null) }}">
                                                    @error('quantity')
                                                        <lable style="color: red">{{ $errors->first('quantity') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Discount</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number"
                                                        class="form-control @error('discount') border border-danger @enderror"
                                                        name="discount" placeholder="Discount"
                                                        value="{{ old('discount', $voucher->discount ?? null) }}">
                                                    @error('discount')
                                                        <lable style="color: red">{{ $errors->first('discount') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Start date</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date"
                                                        class="form-control @error('start_date') border border-danger @enderror"
                                                        name="start_date" placeholder="Content"
                                                        value="{{ old('start_date', $voucher->effective_date ?? null) }}">
                                                    @error('start_date')
                                                        <lable style="color: red">{{ $errors->first('start_date') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>End date</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="date"
                                                        class="form-control @error('end_date') border border-danger @enderror"
                                                        name="end_date" placeholder="Content"
                                                        value="{{ old('end_date', $voucher->expiration_date ?? null) }}">
                                                    @error('end_date')
                                                        <lable style="color: red">{{ $errors->first('end_date') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                            <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                                value="{{ !isset($voucher) ? 'Thêm mới' : 'Cập nhật' }}">
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
