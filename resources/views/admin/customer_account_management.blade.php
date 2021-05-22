@extends('layout.layout_admin')
@section('title', 'Quản lý tài khoản')
@section('content')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.customerAccountManagement') }}" method="get" class="form form-horizontal">
                        <div class="row">
                            <div class="col-xl-5 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Email</label>
                                    <input type="text" class="form-control" name="s_email"
                                        value="{{ request()->s_email }}">
                                </fieldset>
                            </div>
                            <div class="col-xl-5 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Username</label>
                                    <input type="text" class="form-control" name="s_username"
                                        value="{{ request()->s_username }}">
                                </fieldset>
                            </div>
                            <div class="col-xl-5 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Status</label>
                                    <select class="select2 form-control" name="s_status">
                                        <option></option>
                                        <option value="1" {{ request()->s_status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="2" {{ request()->s_status == 2 ? 'selected' : '' }}>Block</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-5 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Full Name</label>
                                    <input type="text" class="form-control" name="s_full_name"
                                        value="{{ request()->s_full_name }}">
                                </fieldset>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <fieldset class="form-group" style="margin-top: 18px; margin-left: 100px">
                                    <label for="basicInput"></label>
                                    <input class="btn btn-info" type="submit" value="Search..." name="btn_search" />
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="text-align: right; margin-top: 20px">
            <a href="/createAccAdmin" class="btn bg-gradient-success mr-1 mb-1"><i class="feather icon-plus-square"></i> Add
                Account</a>
        </div>
        <!-- dataTable starts -->
        @include('flash::message')
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Full name</th>
                        <th>Date of birth</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $key => $value)
                        <tr>
                            <td></td>
                            <td class="product-name">{{ $value->email }}</td>
                            <td class="product-name">{{ $value->username }}</td>
                            <td class="product-category">{{ $value->full_name }}</td>
                            <td class="product-price">{{ $value->birth_date }}</td>
                            <td class="product-price">
                                @if ($value->status == 1)
                                    <div class="chip chip-success mr-1">
                                        <div class="chip-body">
                                            <span class="chip-text"> Active</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="chip chip-danger mr-1">
                                        <div class="chip-body">
                                            <span class="chip-text"> Block</span>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="product-action">
                                @if ($value->status == 1)
                                    <span class="btn bg-gradient-danger mr-1 mb-1 waves-effect waves-light"
                                        data-toggle="modal" data-target="#danger{{ $value->id }}"><i
                                            class="fa fa-times-circle"></i> Block</span>
                                @else
                                    <span class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light"
                                        data-toggle="modal" data-target="#danger{{ $value->id }}"><i
                                            class="fa fa-check-circle"></i> Active</span>
                                @endif
                                <div class="modal fade text-left" id="danger{{ $value->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger white">
                                                <h5 class="modal-title" id="myModalLabel120">Cảnh báo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn thay đổi trạng thái tài khoản?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('change_status_acc_user', $value->id) }}"
                                                    method="post">
                                                    @method('put')
                                                    <input class="btn btn-danger" type="submit" value="Thay đổi" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{!! $customers->render() !!}</div>
        </div>
        <!-- dataTable ends -->
    </section>


@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/pages/data-list-view.css') }}">
@stop

@section('scripts')
    <script src="{{ asset('css/app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>

@stop
