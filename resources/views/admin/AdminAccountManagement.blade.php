@extends('layout.template_admin')
@section('title','Quản lý tài khoản')
@section('noidung')
    @if(Session::has('deleteAcc'))
        <div class="alert alert-success">{{Session::get('deleteAcc')}}</div>
    @endif
    <div style="text-align: center"><a class="btn btn-info" href="createAccAdmin">Tạo tài khoản</a></div><br><br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Họ và tên</th>
            <th scope="col">Email</th>
            <th scope="col">Điện thoại</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Chức năng</th>
        </tr>
        </thead>
        <tbody class="thongTinEmployee">
        @foreach($employee as $key=>$employees)
            <tr>
                <th scope="row">{{ $employees->employeeName }}</th>
                <td>{{ $employees->email }}</td>
                <td>{{ $employees->phone }}</td>
                @if($employees->level==1)
                    <td style="color: red">Admin</td>
                @elseif($employees->level==2)
                    <td style="color: green">Nhân viên</td>
                @elseif($employees->level==3)
                    <td style="color: green">Shipper</td>
                @endif
                <form action="/deleteAcc" method="post">
                    <input type="hidden" name="id" value="{{$employees->id}}">
                    <td><input type="submit" class="btn btn-danger" value="Xóa"></td>
                </form>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr id='btnLoadMore'>
            <td scope="row">
                <button class="btn btn-info load-more" id="btnLoad4" data-id="{{$employees->created_at}}">Xem thêm...</button>
            </td>
        </tr>
        </tfoot>
    </table>

@endsection
