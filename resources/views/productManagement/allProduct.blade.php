@extends('layout.layout_admin')
@section('title', 'Admin')
@section('content')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('product.management') }}" method="get" class="form form-horizontal">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Name</label>
                                    <input type="text" class="form-control" name="s_name_product"
                                        value="{{ request()->s_name_product }}">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Status</label>
                                    <select class="select2 form-control" name="s_status">
                                        <option></option>
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Supplier</label>
                                    <input type="text" class="form-control" name="s_supplier"
                                        value="{{ request()->s_supplier }}">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <fieldset class="form-group">
                                    <label for="basicInput">First category</label>
                                    <select class="select2 form-control" id="menucha" name="s_category1">
                                        <option></option>
                                        @foreach ($category as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ request()->s_category1 == $value->id ? 'selected' : '' }}>
                                                {{ $value->category_name }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <fieldset class="form-group">
                                    <label for="basicInput">Second category</label>
                                    <select class="select2 form-control" id="menucon" name="s_category">
                                        @if (isset(request()->s_category))
                                            @foreach ($subCategory as $key => $valueSubCategory)
                                                <option value="{{ $valueSubCategory->id }}"
                                                    {{ $valueSubCategory->id == request()->s_category ? 'selected' : '' }}>
                                                    {{ $valueSubCategory->category_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
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
            <a href="/addProduct" class="btn bg-gradient-success mr-1 mb-1"><i class="feather icon-plus-square"></i> Add
                product</a>
        </div>
        <!-- dataTable starts -->
        @include('flash::message')
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $key => $value)
                        <tr>
                            <td></td>
                            <td class="product-img"><img src="{{ asset('img') }}/{{ $value->image }}"
                                    alt="Img placeholder" width="250px" height="250px">
                            </td>
                            <td class="product-name">{{ $value->product_name }}</td>
                            <td class="product-category">{{ $value->supplier }}</td>
                            <td>
                                @if ($value->status == 1)
                                    <div class="chip chip-success mr-1">
                                        <div class="chip-body">
                                            <span class="chip-text"> Hiển thị</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="chip chip-danger mr-1">
                                        <div class="chip-body">
                                            <span class="chip-text"> Ẩn</span>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $value->discount }}%</td>
                            <td class="product-price">{{ number_format($value->unit_price) }} .Đ</td>
                            <td>{{ $value->quantity }}</td>
                            <td class="product-action">
                                <a href="/repair&id={{ $value->id }}"><i class="feather icon-edit"></i></a>
                                <span class="action-delete" data-toggle="modal" data-target="#danger{{ $value->id }}"><i
                                        class="feather icon-trash"></i></span>
                                <!-- Modal -->
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
                                                Bạn có chắc muốn xóa sản phẩm này?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('delete_product', $value->id) }}" method="post">
                                                    @method('delete')
                                                    <input class="btn btn-danger" type="submit" value="Delete" />
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
            <div>{!! $product->render() !!}</div>
        </div>
        <!-- dataTable ends -->
    </section>


@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/plugins/file-uploaders/dropzone.css') }}">
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

    <script src="{{ asset('js/back_end/addProduct.js') }}"></script>
    {{-- <script src="{{asset('css/app-assets/js/scripts/ui/data-list-view.js')}}"></script> --}}
@stop
