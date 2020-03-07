@extends('layout.template_user')
@section('title','Sản phẩm')
@section('noidung')

<div class="main container-fluid">
            <div class="row">
            <div class="danhMuc col-md-2">
                <div class="custom-control custom-checkbox mb-3">
				    <div class="boloc">BỘ LỌC TÌM KIẾM</div>
				    <div class="form-boloc">
				    <form>
				    <input type="reset" class="btn btn-info" value="Xóa hết"> <br><br>
				    <label style="font-size: 20px; color: #1a9cb7;">Lựa chọn sắp xếp:</label>
				    <select class="form-control sapxep-gia" id="sapxep" @if(isset($categoryID))data-memu="{{$categoryID }}"
                        @else data-search="{{$search1}}" @endif>
				    <option value="">Tùy chọn</option>
				    <option value="0" >Giá tăng dần</option>
				    <option value="1" >Giá giảm dần</option>
				    </select>
				    <input type="checkbox" id="fruit1" @if(isset($categoryID))data-memu="{{$categoryID }}"
                           @else data-search="{{$search1}}" @endif name="latestProduct-1" value="">
				    <label for="fruit1">Mới nhất</label>
				    <input type="checkbox" id="fruit2" name="latestProduct-2" value="">
				    <label for="fruit2">Bán chạy</label><br>
				    <label style="font-size: 20px; color: #1a9cb7;">Thương hiệu:</label>
				    <input type="checkbox" id="fruit3" name="fruit-3" value="Cherry">
				    <label for="fruit3">Nike</label>
				    <input type="checkbox" id="fruit4" name="fruit-4" value="Strawberry">
				    <label for="fruit4">Adidas</label>
				    <input type="checkbox" id="fruit5" name="fruit-5" value="Strawberry">
				    <label for="fruit5">Converse</label>
				    </form>
				    </div>
				</div>
            </div>
            <div class="sanPham col-md-9">
                <div class="text-dexuat"><h1>___________Sản phẩm bạn cần___________</h1></div>
				<div class="row sanPham1" id="broad">

					@foreach ($product as $key => $value)

				    <div class="item1">
				        <div class="col-xs-12 col-sm-6 col-md-2 hang">
				        <a href="/detail&id={{ $value->id }}" class="chitiet">
				        	<img src="{{asset('img')}}/{{$value->image}}" class="img-responsive center-block">

					        <h4 class="text-center">{{ $value->productName}}</h4>

					        <h5 class="text-center" style="color:red;">
                                {{ number_format($value->unitPrice)}} .Đ
                                </h5>
					        <h6 class="text-center"></h6>
				    	</a>
				        </div>
				    </div>
				   @endforeach
				</div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        @if(isset($search1))
                            {!! $product->withPath('search?search='.$search1 ); !!}
                        @else
                            {!! $product->render(); !!}
                        @endif
                    </div>
                    <div class="col-md-4"></div>
                </div>

            </div>
            </div>
        </div>
<script src="{{ asset('js/font_end/sortProduct.js') }}"></script>
@endsection

