@extends('layout.layout_admin')
@section('title', 'Quản lý tài khoản')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($slideshow))
                        <h4 class="card-title">Update slideshow</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('slideshow.update', $slideshow->id) }}" method="post"
                            enctype="multipart/form-data" class="form form-horizontal">
                            @method('PUT')
                        @else
                            <h4 class="card-title">Thêm mới slideshow</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/storeSlideshow" method="post" enctype="multipart/form-data"
                                class="form form-horizontal">
                                @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Title</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('title') border border-danger @enderror"
                                                        name="title" placeholder="Title"
                                                        value="{{ old('title', $slideshow->title ?? null) }}">
                                                    @error('title')
                                                        <lable style="color: red">{{ $errors->first('title') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Content</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                        class="form-control @error('content') border border-danger @enderror"
                                                        name="content" placeholder="Content"
                                                        value="{{ old('content', $slideshow->content ?? null) }}">
                                                    @error('content')
                                                        <lable style="color: red">{{ $errors->first('content') }}</lable>
                                                        <br><br>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <span>Image</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput"
                                                            class="@error('image') text-danger @enderror">Ảnh</label>
                                                        <div class="custom-file">
                                                            <input type="file"
                                                                class="form-control @error('image') border border-danger @enderror"
                                                                name="image" id="basicInput" onchange="previewFile(this);">
                                                        </div>
                                                        <p>
                                                            <img id="image"
                                                                src="{{ asset('img') }}/{{ isset($slideshow) ? $slideshow->img_slideshow : '' }}"
                                                                @if (!isset($slideshow)) class="hidden" @endif
                                                                height="300">
                                                        </p>
                                                        @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-4">
                                            <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                                value="{{ !isset($slideshow) ? 'Thêm mới' : 'Cập nhật' }}">
                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            function previewFile(input) {
                var file = $("input[type=file]").get(0).files[0];

                if (file) {
                    var reader = new FileReader();

                    reader.onload = function() {
                        $("#image").attr("src", reader.result);
                        if ($("#image").hasClass('hidden')) {
                            $("#image").removeClass('hidden')
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }

        </script>
    @stop
