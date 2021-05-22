 @extends('layout.layout_admin')
 @section('title', 'Sản phẩm')
 @section('content')
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6 col-12">
             <div class="card">
                 <div class="card-header">
                     @if (isset($product))
                         <h4 class="card-title">Update sản phẩm</h4>
                 </div>
                 <div class="card-content">
                     <div class="card-body">
                         <form action="{{ route('update_product', $product->id) }}" method="post"
                             enctype="multipart/form-data" class="form form-horizontal">
                             @method('PUT')
                         @else
                             <h4 class="card-title">Thêm mới sản phẩm</h4>
                     </div>
                     <div class="card-content">
                         <div class="card-body">
                             <form action="/addProduct" method="post" enctype="multipart/form-data"
                                 class="form form-horizontal">
                                 @endif
                                 <div class="form-body">
                                     <div class="row">
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Tên sản phẩm</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <input type="text"
                                                         class="form-control @error('product_name') border border-danger @enderror"
                                                         name="product_name" placeholder="Tên sản phẩm"
                                                         value="{{ old('product_name', $product->product_name ?? null) }}">
                                                     @error('product_name')
                                                         <lable style="color: red">{{ $errors->first('product_name') }}
                                                         </lable><br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Tên công ty</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <input type="text"
                                                         class="form-control @error('supplier') border border-danger @enderror"
                                                         name="supplier" placeholder="Tên công ty"
                                                         value="{{ old('supplier', $product->supplier ?? null) }}">
                                                     @error('supplier')
                                                         <lable style="color: red">{{ $errors->first('supplier') }}</lable>
                                                         <br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Số lượng</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <input type="number"
                                                         class="form-control @error('quantity') border border-danger @enderror"
                                                         name="quantity" placeholder="Số lượng"
                                                         value="{{ old('quantity', $product->quantity ?? null) }}">
                                                     @error('quantity')
                                                         <lable style="color: red">{{ $errors->first('quantity') }}</lable>
                                                         <br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Giá (VND)</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <input type="number"
                                                         class="form-control @error('unit_price') border border-danger @enderror"
                                                         name="unit_price" placeholder="(VND)"
                                                         value="{{ old('unit_price', $product->unit_price ?? null) }}">
                                                     @error('unit_price')
                                                         <lable style="color: red">{{ $errors->first('unit_price') }}</lable>
                                                         <br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Giảm giá (%)</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <input type="number"
                                                         class="form-control @error('discount') border border-danger @enderror"
                                                         name="discount" placeholder="(%)"
                                                         value="{{ old('discount', $product->discount ?? null) }}">
                                                     @error('discount')
                                                         <lable style="color: red">{{ $errors->first('discount') }}</lable>
                                                         <br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Mô tả sản phẩm</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <fieldset class="form-group">
                                                         <textarea
                                                             class="form-control @error('description') border border-danger @enderror"
                                                             name="description" id="basicTextarea" rows="3"
                                                             placeholder="Mô tả sản phẩm">{{ old('description', $product->description ?? null) }}</textarea>
                                                         @error('description')
                                                             <lable style="color: red">{{ $errors->first('description') }}
                                                             </lable><br><br>
                                                         @enderror
                                                     </fieldset>
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
                                                                 src="{{ asset('img') }}/{{ isset($product) ? $product->image : '' }}"
                                                                 @if (!isset($product)) class="hidden" @endif
                                                                 height="300">
                                                         </p>
                                                         @error('image')
                                                             <div class="text-danger">{{ $message }}</div>
                                                         @enderror
                                                     </fieldset>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Size</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <ul class="list-unstyled mb-0">
                                                         <li class="d-inline-block mr-2">
                                                             <fieldset>
                                                                 <div class="vs-checkbox-con vs-checkbox-primary">
                                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->size_s == 1) || old('size_s') == true) checked @endif
                                                                         name="size_s">
                                                                     <span class="vs-checkbox">
                                                                         <span class="vs-checkbox--check">
                                                                             <i class="vs-icon feather icon-check"></i>
                                                                         </span>
                                                                     </span>
                                                                     <span class="">S</span>
                                                                 </div>
                                                             </fieldset>
                                                         </li>
                                                         <li class="d-inline-block mr-2">
                                                             <fieldset>
                                                                 <div class="vs-checkbox-con vs-checkbox-success">
                                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->size_m == 1) || old('size_m') == true) checked @endif
                                                                         name="size_m">
                                                                     <span class="vs-checkbox">
                                                                         <span class="vs-checkbox--check">
                                                                             <i class="vs-icon feather icon-check"></i>
                                                                         </span>
                                                                     </span>
                                                                     <span class="">M</span>
                                                                 </div>
                                                             </fieldset>
                                                         </li>
                                                         <li class="d-inline-block mr-2">
                                                             <fieldset>
                                                                 <div class="vs-checkbox-con vs-checkbox-danger">
                                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->size_l == 1) || old('size_l') == true) checked @endif
                                                                         name="size_l">
                                                                     <span class="vs-checkbox">
                                                                         <span class="vs-checkbox--check">
                                                                             <i class="vs-icon feather icon-check"></i>
                                                                         </span>
                                                                     </span>
                                                                     <span class="">L</span>
                                                                 </div>
                                                             </fieldset>
                                                         </li>
                                                         <li class="d-inline-block mr-2">
                                                             <fieldset>
                                                                 <div class="vs-checkbox-con vs-checkbox-info">
                                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->size_xl == 1) || old('size_xl') == true) checked @endif
                                                                         name="size_xl">
                                                                     <span class="vs-checkbox">
                                                                         <span class="vs-checkbox--check">
                                                                             <i class="vs-icon feather icon-check"></i>
                                                                         </span>
                                                                     </span>
                                                                     <span class="">XL</span>
                                                                 </div>
                                                             </fieldset>
                                                         </li>
                                                         <li class="d-inline-block">
                                                             <fieldset>
                                                                 <div class="vs-checkbox-con vs-checkbox-warning">
                                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->size_xxl == 1) || old('size_xxl') == true) checked @endif
                                                                         name="size_xxl">
                                                                     <span class="vs-checkbox">
                                                                         <span class="vs-checkbox--check">
                                                                             <i class="vs-icon feather icon-check"></i>
                                                                         </span>
                                                                     </span>
                                                                     <span class="">XXL</span>
                                                                 </div>
                                                             </fieldset>
                                                         </li>
                                                     </ul>
                                                     @error('size')
                                                         <lable style="color: red">{{ $errors->first('size') }}</lable>
                                                         <br><br>
                                                     @enderror
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Menu cha</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <div class="form-group">
                                                         <select class="select2 form-control" id="menucha"
                                                             name="category_1">
                                                             <option></option>
                                                             @foreach ($category as $key => $value)
                                                                 <option value="{{ $value->id }}"
                                                                     {{ (isset($product) && $value->id == $subCategoryById[0]->sub_category_id) || $value->id == old('category_1') ? 'selected' : '' }}>
                                                                     {{ $value->category_name }}</option>
                                                             @endforeach
                                                         </select>
                                                         @error('category_1')
                                                             <lable style="color: red">{{ $errors->first('category_1') }}
                                                             </lable><br><br>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group row">
                                                 <div class="col-md-4">
                                                     <span>Menu con</span>
                                                 </div>
                                                 <div class="col-md-8">
                                                     <div class="form-group">
                                                         <select class="select2 form-control" id="menucon"
                                                             name="category_2">
                                                             @if (isset($product))
                                                                 @foreach ($subCategory as $key => $valueSubCategory)
                                                                     <option value="{{ $valueSubCategory->id }}"
                                                                         {{ isset($product) && $valueSubCategory->id == $product->category_id ? 'selected' : '' }}>
                                                                         {{ $valueSubCategory->category_name }}</option>
                                                                 @endforeach
                                                             @endif
                                                         </select>
                                                         @error('category_2')
                                                             <lable style="color: red">{{ $errors->first('category_2') }}
                                                             </lable><br><br>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group col-md-8 offset-md-4">
                                             <fieldset class="checkbox">
                                                 <div class="vs-checkbox-con vs-checkbox-primary">
                                                     <input type="checkbox" value="true" @if ((isset($product) && $product->status == 1) || old('status') == true) checked @endif name="status">
                                                     <span class="vs-checkbox">
                                                         <span class="vs-checkbox--check">
                                                             <i class="vs-icon feather icon-check"></i>
                                                         </span>
                                                     </span>
                                                     <span class="">Hiển thị</span>
                                                 </div>
                                             </fieldset>
                                         </div>
                                         <div class="col-md-8 offset-md-4">
                                             <input type="submit" class="btn btn-primary mr-1 mb-1" name="btn_add"
                                                 value="{{ !isset($product) ? 'Thêm mới' : 'Cập nhật' }}">
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
         <script src="{{ asset('js/back_end/addProduct.js') }}"></script>
     @stop
