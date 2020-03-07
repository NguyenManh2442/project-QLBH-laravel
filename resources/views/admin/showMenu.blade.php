@extends('layout.template_admin')
@section('title','Menu')
@section('noidung')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Menu cha</th>
            <th scope="col">Menu con</th>
            <th scope="col">Chức năng</th>
        </tr>
        </thead>
        <tbody class="thongTinOrder">
        @foreach($category as $key => $categorys)
            <tr>
                <th scope="row">{{$categorys->categoryName}} :</th>
                <td>
                @foreach($category1 as $categorys1)
                    @if($categorys1->subCategoryID == $categorys->categoryID)
                    + {{$categorys1->categoryName}}<br>
                    @endif
                @endforeach
                </td>
                <td><a href="repairMenu&id={{ $categorys->categoryID }}" class="btn btn-info">Sửa</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
