
@extends('layout.template_user')
@section('title','Trang chủ')
@section('noidung')
<!-- ------------------------------------SLIDESHOW----------------------- -------------->
            <div class="slideshow">
               <div class="slider-area">
				    <div id="carousel-example-generic" class="carousel slide sua" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">

				        <?php $i=0 ?>
				        @if(count($slideshow))
				          @foreach ($slideshow as $value)
				            @if($i==0)
				              <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="active"></li>
							  <?php $i++ ?>

				            @else
				             <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
							 <?php $i++ ?>

                            @endif

                          @endforeach

				        @endif
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">

				  		<?php $a=0 ?>
				        @if(count($slideshow))
				          @foreach ($slideshow as $value)
				            @if($a==0)
				              <div class="item active">
				                    <img src="{{asset('img')}}/{{$value->img_slideshow}}" alt="1">
				                    <div class="carousel-caption">
				                      <h2>{{$value->title}}</h2>
				                      <h3>{{$value->content}}</h3>
				                    </div>
				                  </div>
								  <?php $a++ ?>

				            @else
				               <div class="item">
				                  <img src="{{asset('img')}}/{{$value->img_slideshow}}" alt="2">
				                  <div class="carousel-caption">
				                    <h2>{{$value->title}}</h2>
				                    <h3>{{$value->content}}</h3>
				                  </div>
				                </div>
								<?php $a++ ?>

				            @endif
				          @endforeach
				        @endif


				  </div>

				  <!-- Controls -->
					  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
<!-- --------------------------------------------end slide----------------------- -->
<div class="row">
    <!-- -----------------------------DANH MỤC-------------------- -->
    <div class="danhMuc col-md-1">

    </div>
    <!-- -------------------------------------END DANH MỤC----------------------- -->
    <div class="sanPham col-md-10">

        <div class="text-dexuat"><h1>_______Đề xuất cho bạn_______</h1> </div>
        <div class="row sanPham1">

            @foreach ($productRandom as $key => $value)

            <div class="item1">
                <div class="col-xs-12 col-sm-6 col-md-2 hang">
                    <a href="/detail&id={{ $value->id }}" class="chitiet">
                        <img src="{{asset('img')}}/{{$value->image}}" class="img-responsive center-block">
                        <h4 class="text-center">{{ $value->productName}}</h4>
                        <h5 class="text-center" style="color:red;">{{ number_format($value->unitPrice)}} .Đ</h5>
                        <h6 class="text-center"></h6>
                    </a>
                </div>
            </div>

            @endforeach

            <a href="getproductOffer" class="btn btn-info xemthem">Xem thêm...</a>
        </div>

        <div class="text-dexuat"><h1>_______Sản phẩm bán chạy_______</h1> </div>
        <div class="row sanPham1">

            @foreach ($popularSellingProducts as $key2 => $value2)

                <div class="item1">
                    <div class="col-xs-12 col-sm-6 col-md-2 hang">
                        <a href="/detail&id={{ $value2->id }}" class="chitiet">
                            <img src="{{asset('img')}}/{{$value2->image}}" class="img-responsive center-block">
                            <h4 class="text-center">{{ $value2->productName}}</h4>
                            <h5 class="text-center" style="color:red;">{{ number_format($value2->unitPrice)}} .Đ</h5>
                            <h6 class="text-center"></h6>
                        </a>
                    </div>
                </div>

            @endforeach

            <a href="/getPopularSellingProducts" class="btn btn-info xemthem">Xem thêm...</a>
        </div>
    </div>
</div>
<!-- -------------------------------------SLIDE SẢN PHẨM----------------------- -->

<div class="slideSanPham">
    <div class="container-fluid">
        <div class="text-sp-slide"><h1>_______Bộ sưu tập mới_______</h1></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                    <div class="carousel-inner">
                        @php
                          $a=0;
                        @endphp
                        @if(count($newProduct))
                            @foreach ($newProduct as $value)
                                @if($a==0)
                                    <div class="item active">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
									          <a href="/detail&id={{ $value->id }}">
                                                  <img src="{{asset('img')}}/{{$value->image}}" class="img-responsive center-block">
                                                  <h4 class="text-center">{{ $value->productName}}</h4>
                                                  <h5 class="text-center" style="color:red;">{{ number_format($value->unitPrice)}} .Đ</h5>
                                              </a>
                                        </div>
									</div>
                                        @php
                                            $a++;
                                        @endphp

                                @else
                                    <div class="item">
									    <div class="col-xs-12 col-sm-6 col-md-2">
									         <a href="/detail&id={{ $value->id }}">
                                             <img src="{{asset('img')}}/{{$value->image}}" class="img-responsive center-block">
									         <h4 class="text-center">{{ $value->productName}}</h4>
									         <h5 class="text-center" style="color:red;">{{ number_format($value->unitPrice)}} .Đ</h5></a>
									    </div>
                                    </div>
                                    @php
                                        $a++;
                                    @endphp
                                @endif
                            @endforeach
                        @endif

                    </div>
                    <!-- left,right control -->
                    <div id="slider-control">
                        <a class="left carousel-control" href="#itemslider" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        </a>
                        <a class="right carousel-control" href="#itemslider" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -----------------------------------END SLIDE SẢN PHẨM----------------------- -->
@endsection
