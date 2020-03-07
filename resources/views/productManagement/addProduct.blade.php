@extends('layout.template_admin')
@section('title','Thêm sản phẩm')
@section('noidung')

    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4 suatt">
            <form action="/addProduct" method="post" onsubmit="return ValidateForm(); " enctype="multipart/form-data">
                <div><h3>THÊM SẢN PHẨM</h3></div><br>
                <label>Vui lòng điền đầy đủ thông tin sản phẩm</label><br>
                    @if(Session::has('themsp'))
                        <div class="alert alert-success">{{Session::get('themsp')}}</div>
                    @endif
                <!-- ----------------------------------------------------------- -->
                <label>Tên sản phẩm: </label><input type="text" class="form-control" name="productName" id="username"  >

                <!-- ----------------------------------------------------------- -->
                <label>Giá sản phẩm: </label><input type="text" class="form-control" name="unitPrice" id="fullName" >

                <!-- ----------------------------------------------------------- -->
                <label>Số lượng có: </label><input type="text" class="form-control" name="quantity" id="phone" ><br>

                <!-- ----------------------------------------------------------- -->
                <label>File ảnh: </label>
                <input type="file" name="fileImg"><br>

                <!-- ----------------------------------------------------------- -->
                <label>Chọn menu cha: </label>
                <select name="menucha" id="menucha" class="form-control">
                    <option value="" >Menu cha</option>
                    @foreach($category1 as $key=>$value)
                        <option value="{{ $value->categoryID }}" >{{ $value->categoryName }}</option>
                    @endforeach
                </select>
                <label>Chọn menu con: </label>
                <select name="menucon" id="menucon" class="form-control">
                    <option value="0" >Menu con</option>

                </select>

                <label >Mô tả sản phẩm</label>
                <textarea class="form-control" name="mota" id="exampleFormControlTextarea1" rows="3"></textarea><br>

                <!-- ----------------------------------------------------------- -->
                <input type="submit" name="btnLuu" id="" class="btn btn-info" value="Xác nhận"><br><br>
            </form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection

