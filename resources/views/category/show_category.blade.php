@extends('layout.layout_admin')
@section('title', 'Menu')
@section('content')
    @include('flash::message')
    <div style="text-align: right; margin-top: 20px">
        <a href="/createCategory" class="btn bg-gradient-success mr-1 mb-1"><i class="feather icon-plus-square"></i> Add
            category</a>
    </div>
    <section id="collapsible">
        <div class="row">
            <div class="col-sm-12">
                <div class="card collapse-icon accordion-icon-rotate">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="default-collapse collapse-bordered">
                                <div class="table-responsive">
                                    <table class="table data-thumb-view">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $key => $value)
                                                <tr>
                                                    <td></td>
                                                    <td class="product-name">
                                                        <div class="card collapse-header">
                                                            <div id="headingCollapse{{ $value->id }}" class="card-header"
                                                                data-toggle="collapse" role="button"
                                                                data-target="#collapse{{ $value->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="collapse{{ $value->id }}">
                                                                <span class="lead collapse-title">
                                                                    {{ $value->category_name }}
                                                                </span>
                                                            </div>
                                                            <div id="collapse{{ $value->id }}" role="tabpanel"
                                                                aria-labelledby="headingCollapse{{ $value->id }}"
                                                                class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table data-thumb-view">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>Sub Category</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($subCategory as $valueSubCategory)
                                                                                        @if ($valueSubCategory->sub_category_id == $value->id)
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td class="product-name">
                                                                                                    {{ $valueSubCategory->category_name }}
                                                                                                </td>
                                                                                                <td class="product-action">
                                                                                                    <a
                                                                                                        href="/editCategory&id={{ $valueSubCategory->id }}"><i
                                                                                                            class="feather icon-edit"></i></a>
                                                                                                    <span
                                                                                                        class="action-delete"
                                                                                                        data-toggle="modal"
                                                                                                        data-target="#danger{{ $valueSubCategory->id }}"><i
                                                                                                            class="feather icon-trash"></i></span>
                                                                                                    <!-- Modal -->
                                                                                                    <div class="modal fade text-left"
                                                                                                        id="danger{{ $valueSubCategory->id }}"
                                                                                                        tabindex="-1"
                                                                                                        role="dialog"
                                                                                                        aria-labelledby="myModalLabel120"
                                                                                                        aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                                            role="document">
                                                                                                            <div
                                                                                                                class="modal-content">
                                                                                                                <div
                                                                                                                    class="modal-header bg-danger white">
                                                                                                                    <h5 class="modal-title"
                                                                                                                        id="myModalLabel120">
                                                                                                                        Cảnh
                                                                                                                        báo
                                                                                                                    </h5>
                                                                                                                    <button
                                                                                                                        type="button"
                                                                                                                        class="close"
                                                                                                                        data-dismiss="modal"
                                                                                                                        aria-label="Close">
                                                                                                                        <span
                                                                                                                            aria-hidden="true">&times;</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="modal-body">
                                                                                                                    Bạn có
                                                                                                                    chắc
                                                                                                                    muốn xóa
                                                                                                                    category
                                                                                                                    này?
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="modal-footer">
                                                                                                                    <form
                                                                                                                        action="{{ route('category.deleteCategory', $valueSubCategory->id) }}"
                                                                                                                        method="post">
                                                                                                                        @method('delete')
                                                                                                                        <input
                                                                                                                            class="btn btn-danger"
                                                                                                                            type="submit"
                                                                                                                            value="Delete" />
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="product-action">
                                                        <a href="/editCategory&id={{ $value->id }}"><i
                                                                class="feather icon-edit"></i></a>
                                                        <span> | </span>
                                                        <span class="action-delete" data-toggle="modal"
                                                            data-target="#danger{{ $value->id }}"><i
                                                                class="feather icon-trash"></i></span>
                                                        <!-- Modal -->
                                                        <div class="modal fade text-left" id="danger{{ $value->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger white">
                                                                        <h5 class="modal-title" id="myModalLabel120">Cảnh
                                                                            báo</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn xóa category này?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('category.deleteCategory', $value->id) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            <input class="btn btn-danger" type="submit"
                                                                                value="Delete" />
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
