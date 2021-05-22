@extends('layout.layout_admin')
@section('title', 'Giảm giá sản phẩm')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Giảm giá sản phẩm</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="/setDiscountProduct" method="post" enctype="multipart/form-data"
                            class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Menu cha</span>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="select2 form-control" id="menucha" name="category_1">
                                                        <option></option>
                                                        @foreach ($category as $key => $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ (isset($product) && $value->id == $subCategoryById[0]->sub_category_id) || $value->id == old('category_1') ? 'selected' : '' }}>
                                                                {{ $value->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_1')
                                                        <lable style="color: red">{{ $errors->first('category_1') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Menu con</span>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="select2 form-control" id="menucon" name="category_2">
                                                    </select>
                                                    @error('category_2')
                                                        <lable style="color: red">{{ $errors->first('category_2') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <span>Giảm giá (%)</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number"
                                                    class="form-control @error('discount') border border-danger @enderror"
                                                    name="discount" placeholder="discount" value="{{ old('discount') }}">
                                                @error('discount')
                                                    <lable style="color: red">{{ $errors->first('discount') }}</lable><br><br>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-4">
                                        <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                            value="Giảm giá">
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
    <script src="{{ asset('js/back_end/addProduct.js') }}"></script>
@stop
