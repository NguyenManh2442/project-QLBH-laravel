@extends('layout.layout_admin')
@section('title', 'Menu')
@section('content')
    @include('flash::message')
    <div style="text-align: right; margin-top: 20px">
        <a href="/createSlideshow" class="btn bg-gradient-success mr-1 mb-1"><i class="feather icon-plus-square"></i> Add
            slideshow</a>
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
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($slideshow as $key => $value)
                                                <tr>
                                                    <td></td>
                                                    <td class="product-img"><img
                                                            src="{{ asset('img') }}/{{ $value->img_slideshow }}"
                                                            alt="Img placeholder" width="500px" height="300px">
                                                    </td>
                                                    <td class="product-name">{{ $value->title }}</td>
                                                    <td class="product-category">{{ $value->content }}</td>
                                                    <td class="product-action">
                                                        <a href="/editSlideshow&id={{ $value->id }}"><i
                                                                class="feather icon-edit"></i></a>
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
                                                                        Bạn có chắc muốn xóa slideshow này?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('slideshow.deleteSlideshow', $value->id) }}"
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
