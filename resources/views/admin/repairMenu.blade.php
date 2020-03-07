@extends('layout.template_admin')
@section('title','Sửa menu')
@section('noidung')

    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4 suatt">
            <form action="/repair-Menu" method="post" onsubmit="return ValidateForm(); " >
                <div><h3>SỬA MENU</h3></div><br>
                @if(Session::has('repairMenu'))
                    <div class="alert alert-success">{{Session::get('repairMenu')}}</div>
                @endif
            <!-- ----------------------------------------------------------- -->
                @foreach($category as $categorys)
                    <input type="hidden" value="{{ $categorys->categoryID }}" name="categoryID">
                    <label>Tên Menu cha: </label><input type="text" class="form-control" name="CategoryParent" id="username" value="{{$categorys->categoryName}}"  ><br>

                    <!-- ----------------------------------------------------------- -->
                    <label>Tên Menu con: </label>
                    @php $i=0; $id=0; @endphp
                    @foreach($category1 as $categorys1)
                        @if($categorys1->subCategoryID == $categorys->categoryID)
                            <input type="hidden" value="{{ $categorys1->categoryID }}" name="categoryChillID{{++$id}}">
                            <input type="text" class="form-control" name="CategoryChill{{++$i}}" id="" value="{{$categorys1->categoryName}}" ><br>
                        @endif
                    @endforeach

                    <!-- ----------------------------------------------------------- -->
            @endforeach
            <!-- ----------------------------------------------------------- -->
                <input type="submit" name="btnLuu" id="" class="btn btn-info" value="Xác nhận"><br><br>
            </form>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection

