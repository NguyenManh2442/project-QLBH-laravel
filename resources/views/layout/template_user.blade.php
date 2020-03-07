<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/banner.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/danhmuc.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/sanpham.css')}}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/slideshow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/footer.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/chonLocSp.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/get_one.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/cart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/slide_sanpham.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font_end/login.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="{{asset('js/font_end/slide_sanpham.js')}}"></script>
    <script src="{{asset('js/font_end/menu.js')}}"></script>
    <script src="{{asset('js/font_end/get_one.js')}}"></script>
    <script src="{{asset('js/font_end/signup.js')}}"></script>



</head>
<body>
    <div>
        <!-- phần header---------------------------------------- -->
        <div class="header container-fluid ">
<!-- ------------------- lien he------------------------------------------ -->
            <div class="lienHe">
                <i class="email far fa-envelope"> E-mail: Nguyenmanh25111999m@gmail.com</i>
				<i class="phone fas fa-mobile-alt"> Phone: 0965729716</i>
            </div>
 <!-- --------------- -------------PHẦN MENU------------------------------------------ -->
            <div class="menu ">
                <sticknav>
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="/trangchu"><img src="{{asset('img/logo.png')}}" alt="" width="150px" height="41px"></a>
				    </div>
				    <div class="collapse navbar-collapse" id="myNavbar">
					      <ul class="nav navbar-nav">
						        <li class="active"><a href="/trangchu"><i class="fas fa-home"></i>Home</a>
						        </li>
						        @foreach($category as $key=>$value)
						        <li class="dropdown">
							          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							          	<i class="fas fa-tshirt"></i>{{$value->categoryName}}<span class="caret"></span></a>
							          <ul class="dropdown-menu">
							          	@foreach($category1 as $key)
										  	@if($key->subCategoryID == $value->categoryID)
												<li>
													<a href="/getproductbycatid/{{$key->categoryID}}">
														{{$key->categoryName}}
													</a>
												</li>
											@endif
							            @endforeach
							          </ul>
						        </li>
						       @endforeach
					    	</ul>
					      <ul class="nav navbar-nav navbar-right">
					          	<li>
					          		<div class="search">
								      <form action="/search" method="get">
									      <div class="form-group">
										    <input class="text" type="text" placeholder=" Search.." name="search">
										    <button class="btn" type="submit"><i class="fa fa-search"></i>
										    </button>
									      </div>
								      </form>
								    </div>
								</li>

								@if (Auth::check())
									<li class="dropdown">
									    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-user-circle"></i> {{Auth::user()->username}}<span class="caret"></span></a>
									    <ul class="dropdown-menu">
									        <li><a href="/updateInfor-form"><i class="far fa-address-card"></i> TT cá nhân</a></li>
                                            <li><a href="/order-products"><i class="fas fa-lock"></i> Sản phẩm đã đặt</a></li>
									        <li><a href="/change-password"><i class="fas fa-lock"></i> Đổi mật khẩu</a></li>
									        <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
									    </ul>
									</li>

								@else

								<li><a href="/signin"><i class="dangNhap fas fa-user"> Đăng nhập</i></a></li>

								@endif



					        <?php
								$numberCart=0;
								$secionCart=session()->get('cart');
							?>
					        	@if (isset($secionCart)) {
					        		@foreach ($secionCart as $key => $value) {
										<?php
											$numberCart ++;
										?>
					        		@endforeach
					        	@endif

					        <li><a href="/cart"><i class="fas fa-shopping-cart"></i> Cart <span class="badge" id="numberCart" >{{ $numberCart }}</span></a></li>
					      </ul>
				    </div>
				  </div>
				</nav>
				</sticknav>
<!-- ----------------------------- END MENU----------------------------------------- -->

            </div>

        </div>
        <!-- -----------------------------------phần main--------------------------- -->
        <div class="main container-fluid">
            @section('noidung')
			@show
        </div>
        <!-- phần footer--------------------------------------- -->
        <div class="footer container-fluid">
            <div class="thongTin">
                <div class="footer row">
					<div class="footer1 col-md-4">
						<h3><b>ĐỊA CHỈ</b></h3>
						<a href="#"><i class="fa fa-shopping-cart"> Giờ mở cửa: 7am-20pm</i></a><br>
						<a href="#"><i class="fa fa-home"> Địa chỉ: Q.Bắc Từ Liêm, TP.Hà Nội</i></a><br>
						<a href="#"><i class="fa fa-phone"> SĐT: 012345678</i></a><br>
						<a href="#"><i class="fa fa-tty"> Hotline: 012345678</i></a>
					</div>

					<div class="footer2 col-md-4">
						<h3><b>DÀNH CHO NGƯỜI MUA</b></h3>
						<ul>
							<li><a href="#"><i class="fas fa-angle-double-right"> Giải quyết khiếu nại</i></a></li>
							<li><a href="#"><i class="fas fa-angle-double-right"> Hướng dẫn mua hàng</i></a></li>
							<li><a href="#"><i class="fas fa-angle-double-right"> Chính sách đổi trả</i></a></li>
							<li><a href="#"><i class="fas fa-angle-double-right"> Chăm sóc khách hàng</i></a></li>

						</ul>
					</div>

					<div class="footer3 col-md-4">
						<h3><b>VỀ CHÚNG TÔI</b></h3>
						<ul>
							<li><a href="#"><i class="fas fa-angle-double-right"> Giới thiệu ABC shop</i></a></li>
							<li><a href="#"><i class="fas fa-angle-double-right"> Quy chế hoạt động</i></a></li>
						</ul>
						<h3><b>KẾT NỐI</b></h3>
						<a href="https://www.facebook.com" target="_blank"><img src="{{asset('img/logoFacebook.png')}}" width="45px" height="45px"></a>
						<a href="https://id.zalo.me" target="_blank"><img src="{{asset('img/logoZalo.png')}}" width="50px" height="50px"></a>
					</div>
				</div>
            </div>
            <div class="banQuyen">
                <address class="add">&copy; Bản quyền thuộc về Nt-Manh</address>
            </div>
        </div>
    </div>
</body>
</html>
