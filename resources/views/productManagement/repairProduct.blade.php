@extends('layout.template_admin')
@section('title','Thêm sản phẩm')
@section('noidung')

    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4 suatt">
            <form action="/repairProduct" method="post" onsubmit="return ValidateForm(); " enctype="multipart/form-data">
                <div><h3>SỬA SẢN PHẨM</h3></div><br>
                <label>Vui lòng điền đầy đủ thông tin sản phẩm</label><br>
                @if(Session::has('addsp'))
                    <div class="alert alert-success">{{Session::get('addsp')}}</div>
            @endif
            <!-- ----------------------------------------------------------- -->
                @foreach($product as $value1)
                    <input type="hidden" value="{{ $value1->id }}" name="id">
                <label>Tên sản phẩm: </label><input type="text" class="form-control" name="productName" id="username" value="{{$value1->productName}}"  >

                <!-- ----------------------------------------------------------- -->
                <label>Giá sản phẩm: </label><input type="text" class="form-control" name="unitPrice" id="fullName" value="{{$value1->unitPrice}}" >

                <!-- ----------------------------------------------------------- -->
                <label>Số lượng có: </label><input type="text" class="form-control" name="quantity" id="phone" value="{{ $value1->quantity }}"  ><br>

                <!-- ----------------------------------------------------------- -->
                <label>File ảnh: </label>
                <input type="file" name="fileImg"><br>

                <!-- ----------------------------------------------------------- -->
                <label>Chọn menu cha: </label>
                <select name="menucha" id="menucha" class="form-control">
                    @foreach($categorycha as $categorychas)
                        <option value="{{ $categorychas->categoryID }}" >{{ $categorychas->categoryName }}</option>
                    @endforeach
                    @foreach($category1 as $key=>$value)
                        <option value="{{ $value->categoryID }}" >{{$value->categoryName}}</option>
                    @endforeach
                </select>
                <label>Chọn menu con: </label>
                <select name="menucon" id="menucon" class="form-control">
                    @foreach($categorycon as $categorycons)
                        <option value="{{ $categorycons->categoryID }}" >{{ $categorycons->categoryName }}</option>
                    @endforeach
                </select>

                <label >Mô tả sản phẩm</label>
                <textarea class="form-control" name="mota" id="exampleFormControlTextarea1" rows="3">{{ $value1->description }}</textarea><br>
                @endforeach
                <!-- ----------------------------------------------------------- -->
                <input type="submit" name="btnLuu" id="" class="btn btn-info" value="Xác nhận"><br><br>
            </form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection

