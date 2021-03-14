@extends('layout.layout_customer')
@section('content')

    @foreach ($product as $value)
        @section('title')
            {{ $value->product_name }}
        @endsection
    @endforeach
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Product Details</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">eCommerce</a>
                            </li>
                            <li class="breadcrumb-item"><a href="app-ecommerce-shop.html">Shop</a>
                            </li>
                            <li class="breadcrumb-item active">Details
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="feather icon-settings"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                            class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- app ecommerce details start -->
        <section class="app-ecommerce-details">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5 mt-2">
                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('img') }}/{{ $product[0]->image }}" class="img-fluid"
                                    alt="product image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <h5>{{ $product[0]->product_name }}
                            </h5>
                            <p class="text-muted">by {{ $product[0]->supplier }}</p>
                            <div class="ecommerce-details-price d-flex flex-wrap">
                                @if ($product[0]->discount == 0)
                                    <p class="text-primary font-medium-3 mr-1 mb-0">
                                        {{ number_format($product[0]->unit_price) }}
                                        .Đ</p>
                                @else
                                    <p class="text-primary font-medium-3 mr-1 mb-0">
                                        {{ number_format($product[0]->unit_price - $product[0]->unit_price * ($product[0]->discount / 100)) }}
                                        .Đ</p>
                                    <p style="font-size: 15px !important; color: #626262;">
                                        <del>{{ number_format($product[0]->unit_price) }}<del>
                                                .Đ</p>
                                @endif
                                <span class="pl-1 font-medium-3 border-left">
                                    <i class="feather icon-star text-warning"></i>
                                    <i class="feather icon-star text-warning"></i>
                                    <i class="feather icon-star text-warning"></i>
                                    <i class="feather icon-star text-warning"></i>
                                    <i class="feather icon-star text-secondary"></i>
                                </span>
                                <span class="ml-50 text-dark font-medium-1">424 ratings</span>
                            </div>
                            <hr>
                            <p>{{ $product[0]->description }}</p>
                            <p class="font-weight-bold mb-25"> <i class="feather icon-truck mr-50 font-medium-2"></i>Free
                                Shipping
                            </p>
                            <hr>
                            <div class="item-quantity">
                                <p class="font-weight-bold">Quantity</p>
                                <div class="input-group quantity-counter-wrapper">
                                    <input type="text" id="sl" class="quantity-counter" value="1">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">Size</label>
                                <ul class="list-unstyled mb-0 product-color-options">
                                    @if ($product[0]->size_s != 0)
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="size" checked="checked" value="S">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">S</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    @endif
                                    @if ($product[0]->size_m != 0)
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="size" value="M">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">M</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    @endif
                                    @if ($product[0]->size_l != 0)
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="size" value="L">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">L</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    @endif
                                    @if ($product[0]->size_xl != 0)
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="size" value="XL">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">XL</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    @endif
                                    @if ($product[0]->size_xxl != 0)
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="size" value="XXL">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">XXL</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <hr>
                            <p>Available - <span class="text-success">In stock</span></p>

                            <div class="d-flex flex-column flex-sm-row">
                                <button class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0" @if (!Auth::check()) data-toggle="modal" data-target="#danger{{ $product[0]->id }}" @else onclick="addCart( {{ $product[0]->id }} )" @endif>
                                    <i class="feather icon-shopping-cart mr-25"></i>
                                    ADD TO CART
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-left" id="danger{{ $product[0]->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger white">
                                                <h5 class="modal-title" id="myModalLabel120">
                                                    Cảnh báo
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Vui lòng đăng nhập để thêm vào giỏ hàng!
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/signin" type="button" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">Đăng nhập</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-icon rounded-circle btn-outline-primary mr-1 mb-1"><i
                                    class="feather icon-facebook"></i></button>
                            <button type="button" class="btn btn-icon rounded-circle btn-outline-info mr-1 mb-1"><i
                                    class="feather icon-twitter"></i></button>
                            <button type="button" class="btn btn-icon rounded-circle btn-outline-danger mr-1 mb-1"><i
                                    class="feather icon-youtube"></i></button>
                            <button type="button" class="btn btn-icon rounded-circle btn-outline-primary mr-1 mb-1"><i
                                    class="feather icon-instagram"></i></button>
                        </div>
                    </div>
                </div>
                <div class="item-features py-5">
                    <div class="row text-center pt-2">
                        <div class="col-12 col-md-4 mb-4 mb-md-0 ">
                            <div class="w-75 mx-auto">
                                <i class="feather icon-award text-primary font-large-2"></i>
                                <h5 class="mt-2 font-weight-bold">100% Original</h5>
                                <p>Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                            <div class="w-75 mx-auto">
                                <i class="feather icon-clock text-primary font-large-2"></i>
                                <h5 class="mt-2 font-weight-bold">10 Day Replacement</h5>
                                <p>Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                            <div class="w-75 mx-auto">
                                <i class="feather icon-shield text-primary font-large-2"></i>
                                <h5 class="mt-2 font-weight-bold">1 Year Warranty</h5>
                                <p>Cotton candy gingerbread cake I love sugar plum I love sweet croissant.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mt-4 mb-2 text-center">
                        <h2>RELATED PRODUCTS</h2>
                        <p>People also search for this items</p>
                    </div>
                    <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Bowers Wilkins - CM10 S2 Triple 6-1/2" 3-Way Floorstanding Speaker (Each) - Gloss
                                        Black
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Bowers & Wilkins</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-2 py-75">
                                    <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$19.98</p>
                                </div>
                            </div>
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Alienware - 17.3" Laptop - Intel Core i7 - 16GB Memory - NVIDIA GeForce GTX 1070 -
                                        1TB Hard Drive +
                                        128GB Solid State Drive - Silver
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Alienware</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-2 py-75">
                                    <img src="../../../app-assets/images/elements/beats-headphones.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$35.98</p>
                                </div>
                            </div>
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Canon - EOS 5D Mark IV DSLR Camera with 24-70mm f/4L IS USM Lens
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Canon</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-3 py-50">
                                    <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$49.98</p>
                                </div>
                            </div>
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Apple - 27" iMac with Retina 5K display - Intel Core i7 - 32GB Memory - 2TB Fusion
                                        Drive - Silver
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Apple</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-2 py-75">
                                    <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$29.98</p>
                                </div>
                            </div>
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Bowers Wilkins - CM10 S2 Triple 6-1/2" 3-Way Floorstanding Speaker (Each) - Gloss
                                        Black
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Bowers & Wilkins</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-2 py-75">
                                    <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$99.98</p>
                                </div>
                            </div>
                            <div class="swiper-slide rounded swiper-shadow">
                                <div class="item-heading">
                                    <p class="text-truncate mb-0">
                                        Garmin - fenix 3 Sapphire GPS Watch - Silver
                                    </p>
                                    <p>
                                        <small>by</small>
                                        <small>Garmin</small>
                                    </p>
                                </div>
                                <div class="img-container w-50 mx-auto my-2 py-75">
                                    <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid"
                                        alt="image">
                                </div>
                                <div class="item-meta">
                                    <div class="product-rating">
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-warning"></i>
                                        <i class="feather icon-star text-secondary"></i>
                                    </div>
                                    <p class="text-primary mb-0">$59.98</p>
                                </div>
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('js/font_end/get_one.js') }}"></script>
    @endsection
