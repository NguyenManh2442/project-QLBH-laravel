@extends('layout.layout_shipper')
@section('title', 'Shipper')
@section('content')
    <section id="nav-filled">
        <div class="row">
            <div class="col-sm-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <h4 class="card-title">Nhận đơn hàng</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active">
                                    <section id="data-thumb-view" class="data-thumb-view-header">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form action="{{ route('shipper.receive_purchase_order') }}"
                                                        method="get" class="form form-horizontal">
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
                                                        <th>Action</th>
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
                                                                @if ($status == 1)
                                                                    <form
                                                                        action="{{ route('shipper.update_status_order', $value->id) }}"
                                                                        method="post">
                                                                        @method('PUT')
                                                                        <input type="submit" name="btn_confirm"
                                                                            class="btn btn-primary mb-1 mb-md-0"
                                                                            value="Nhận đơn" />
                                                                    </form>
                                                                @endif
                                                                @if ($status == 2)
                                                                    <form
                                                                        action="{{ route('shipper.update_status_order', $value->id) }}"
                                                                        method="post">
                                                                        @method('PUT')
                                                                        <input type="submit" name="btn_finish"
                                                                            class="btn btn-success mb-1 mb-md-0"
                                                                            value="Hoàn thành" />
                                                                    </form>
                                                                @endif
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
