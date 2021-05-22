@extends('layout.layout_admin')
@section('title', 'Quản lý tài khoản')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($categoryById))
                        <h4 class="card-title">Update category</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('category.update', $categoryById[0]->id) }}" method="post"
                            class="form form-horizontal">
                            @method('PUT')
                        @else
                            <h4 class="card-title">Thêm mới category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/storeCategory" method="post" class="form form-horizontal">
                                @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Category name</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('category_name') border border-danger @enderror"
                                                        name="category_name" placeholder="Category name"
                                                        value="{{ old('category_name', $categoryById[0]->category_name ?? null) }}">
                                                    @error('category_name')
                                                        <lable style="color: red">{{ $errors->first('category_name') }}
                                                        </lable><br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8 offset-md-4">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="chkCategory" value="true" @if (isset($categoryById) && $categoryById[0]->sub_category_id != 0) checked @endif name="sub_category">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Sub category</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-12" id="category" @if (isset($categoryById))  @if ($categoryById[0]->sub_category_id==0) style="display:
                                            none;" @endif @else style="display: none;" @endif>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Category</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <select class="form-control" name="category">
                                                            @foreach ($category as $value)
                                                                @if (isset($categoryById))
                                                                    @if ($categoryById[0]->id != $value->id)
                                                                        <option value="{{ $value->id }}"
                                                                            {{ isset($categoryById) && $categoryById[0]->sub_category_id == $value->id ? 'selected' : '' }}>
                                                                            {{ $value->category_name }}</option>
                                                                    @endif
                                                                @else
                                                                    <option value="{{ $value->id }}"
                                                                        {{ isset($categoryById) && $categoryById[0]->sub_category_id == $value->id ? 'selected' : '' }}>
                                                                        {{ $value->category_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('role')
                                                            <lable style="color: red">{{ $errors->first('category') }}</lable>
                                                            <br><br>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                            <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                                value="{{ !isset($categoryById) ? 'Thêm mới' : 'Cập nhật' }}">
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
        <script>
            $(function() {
                $("#chkCategory").click(function() {
                    if ($(this).is(":checked")) {
                        $("#category").show();
                    } else {
                        $("#category").hide();
                    }
                });
            });

        </script>
    @stop
