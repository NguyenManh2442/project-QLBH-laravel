@extends('layout.layout_admin')
@section('title', 'Admin')
@section('content')
    <section id="nav-filled">
        <div class="row">
            <div class="col-sm-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <h4 class="card-title">Quản lý đơn hàng</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ $status == 0 ? 'active' : '' }}" id="home-tab-fill"
                                        href="{{ route('order.management', 0) }}" role="tab">Đơn hàng chờ duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $status == 1 ? 'active' : '' }}" id="profile-tab-fill"
                                        href="{{ route('order.management', 1) }}" role="tab">Đơn hàng đã duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $status == 2 ? 'active' : '' }}" id="messages-tab-fill"
                                        href="{{ route('order.management', 2) }}" role="tab">Đơn hàng đang ship</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $status == 3 ? 'active' : '' }}" id="settings-tab-fill"
                                        href="{{ route('order.management', 3) }}" role="tab">Đơn hàng đã ship</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $status == 4 ? 'active' : '' }}" id="settings-tab-fill"
                                        href="{{ route('order.management', 4) }}" role="tab">Đơn hàng đã hủy</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active">
                                    <section id="data-thumb-view" class="data-thumb-view-header">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form action="{{ route('order.management', $status) }}" method="get"
                                                        class="form form-horizontal">
                                                        <div class="row">
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Name</label>
                                                                    <input type="text" class="form-control" name="s_name"
                                                                        value="{{ request()->s_name }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Phone</label>
                                                                    <input type="text" class="form-control" name="s_phone"
                                                                        value="{{ request()->s_phone }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Detailed address</label>
                                                                    <input type="text" class="form-control"
                                                                        name="s_detailed_address"
                                                                        value="{{ request()->s_detailed_address }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Wards</label>
                                                                    <input type="text" class="form-control" name="s_wards"
                                                                        value="{{ request()->s_wards }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">District</label>
                                                                    <input type="text" class="form-control"
                                                                        name="s_district"
                                                                        value="{{ request()->s_district }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Province</label>
                                                                    <input type="text" class="form-control"
                                                                        name="s_province"
                                                                        value="{{ request()->s_province }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                                                <fieldset class="form-group">
                                                                    <label for="basicInput">Order date</label>
                                                                    <input type="date" class="form-control"
                                                                        name="s_order_date"
                                                                        value="{{ request()->s_order_date }}">
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12">
                                                                <fieldset class="form-group"
                                                                    style="margin-top: 18px; margin-left: 100px">
                                                                    <label for="basicInput"></label>
                                                                    <input class="btn btn-info" type="submit"
                                                                        value="Search..." name="btn_search" />
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- dataTable starts -->
                                        @include('flash::message')
                                        <div class="table-responsive">
                                            <table class="table data-thumb-view">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Detailed address</th>
                                                        <th>Wards</th>
                                                        <th>District</th>
                                                        <th>Province</th>
                                                        <th>Order date</th>
                                                        <th>View Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $value)
                                                        <tr>
                                                            <td></td>
                                                            <td class="product">{{ $value->name }}</td>
                                                            <td class="product">{{ $value->phone_number }}</td>
                                                            <td> {{ $value->detailed_address }} </td>
                                                            <td>{{ $value->wards }}</td>
                                                            <td>{{ $value->district }}</td>
                                                            <td>{{ $value->province }}</td>
                                                            <td>{{ $value->order_date }}</td>
                                                            <td class="product-action">
                                                                <a href="/orderdetail&id={{ $value->id }}"><i
                                                                        class="fa fa-th"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div>{!! $orders->render() !!}</div>
                                        </div>
                                        <!-- dataTable ends -->
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
