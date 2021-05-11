@extends('layout.layout_customer')
@section('title')
    Trang chủ
@endsection
@section('content')
    <section id="ecommerce-searchbar">
        <div class="row mt-1">
            <div class="col-sm-12">
                <form action="/" method="GET">
                    <fieldset class="form-group position-relative">
                        <input type="text" class="form-control search-product" id="iconLeft5" placeholder="Search here" name="product_name">
                        <div class="form-control-position">
                            <button type="submit" class="btn btn-icon" style="padding-top: 2px !important;"><i class="feather icon-search"></i></button>
                        </div>
                    </fieldset>
                <form>
            </div>
        </div>
    </section>
    <section>
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div id="carousel-example-generic" class="carousel slide sua" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php $i = 0; ?>
                                @if (count($slideshow))
                                    @foreach ($slideshow as $value)
                                        @if ($i == 0)
                                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"
                                                class="active"></li>
                                            <?php $i++; ?>
                                        @else
                                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}">
                                            </li>
                                            <?php $i++; ?>
                                        @endif
                                    @endforeach
                                @endif
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php $a = 0; ?>
                                @if (count($slideshow))
                                    @foreach ($slideshow as $value)
                                        @if ($a == 0)
                                            <div class="carousel-item active">
                                                <img class="img-fluid"
                                                    src="{{ asset('img') }}/{{ $value->img_slideshow }}"
                                                    alt="First slide" width="1800px" style="height:700px !important">
                                                <div class="carousel-caption">
                                                    <h3>{{ $value->title }}</h3>
                                                    <p>T{{ $value->content }}</p>
                                                </div>
                                            </div>
                                            <?php $a++; ?>
                                        @else
                                            <div class="carousel-item">
                                                <img class="img-fluid"
                                                    src="{{ asset('img') }}/{{ $value->img_slideshow }}"
                                                    alt="Second slide" width="1800px" style="height:700px !important">
                                                <div class="carousel-caption">
                                                    <h3>{{ $value->title }}</h3>
                                                    <p>T{{ $value->content }}</p>
                                                </div>
                                            </div>
                                            <?php $a++; ?>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carousel-example-generic" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-generic" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content-header row">
        <div class="container-fluid" style="width: 1600px">
            <div style="margin: 40px">
                <h2>Sản phẩm bán chạy</h2>
            </div>
            <section id="wishlist" class="grid-view wishlist-items">
                @foreach ($popularSellingProducts as $valueProduct)
                    <div class="card ecommerce-card">
                        <div class="card-content">
                            <div class="item-img text-center">
                                <a href="/detail&id={{ $valueProduct->id }}">
                                    <img src="{{ asset('img') }}/{{ $valueProduct->image }}" class="img-fluid"
                                        alt="img-placeholder" style="height:350px !important" >
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        @if ($valueProduct->discount != 0)
                                        <div class="badge badge-primary badge-md">
                                            - {{ $valueProduct->discount }}%
                                        </div>
                                    @endif
                                    </div>
                                    <div>
                                        <h6 class="item-price">
                                            @if ($valueProduct->discount == 0)
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($valueProduct->unit_price) }}
                                                    .Đ</p>
                                                </br></br>
                                            @else
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($valueProduct->unit_price - $valueProduct->unit_price * ($valueProduct->discount / 100)) }}
                                                    .Đ</p>
                                                <p style="font-size: 15px !important; color: #626262;">
                                                    <del>{{ number_format($valueProduct->unit_price) }}<del>
                                                            .Đ
                                                </p>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                                <div class="item-name">
                                    <a href="/detail&id={{ $valueProduct->id }}">
                                        {{ $valueProduct->product_name }}
                                    </a>
                                </div>
                                <div>
                                    <p class="item-description">
                                        {{ $valueProduct->description }}
                                    </p>
                                </div>
                            </div>
                            <a href="/detail&id={{ $valueProduct->id }}" style="color: wheat">
                                <div class="item-options text-center">
                                    <div class="cart">
                                        <i class="feather icon-shopping-cart"></i> <span>Chi tiết</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </section>
            <div style="text-align: center"><a type="button" href="/getPopularSellingProducts"
                    class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light" style="width: 200px">Xem
                    thêm</a></div>
            <div style="margin: 40px">
                <h2>Sản phẩm mới</h2>
            </div>
            <section id="wishlist" class="grid-view wishlist-items">
                @foreach ($newProduct as $valueNewProduct)
                    <div class="card ecommerce-card">
                        <div class="card-content">
                            <div class="item-img text-center">
                                <a href="/detail&id={{ $valueNewProduct->id }}">
                                    <img src="{{ asset('img') }}/{{ $valueNewProduct->image }}" class="img-fluid"
                                        alt="img-placeholder" style="height:350px !important" >
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        @if ($valueNewProduct->discount != 0)
                                            <div class="badge badge-primary badge-md">
                                                - {{ $valueNewProduct->discount }}%
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="item-price">
                                            @if ($valueNewProduct->discount == 0)
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($valueNewProduct->unit_price) }}
                                                    .Đ</p>
                                                </br></br>
                                            @else
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($valueNewProduct->unit_price - $valueNewProduct->unit_price * ($valueNewProduct->discount / 100)) }}
                                                    .Đ</p>
                                                <p style="font-size: 15px !important; color: #626262;">
                                                    <del>{{ number_format($valueNewProduct->unit_price) }}<del>
                                                            .Đ
                                                </p>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                                <div class="item-name">
                                    <a href="/detail&id={{ $valueNewProduct->id }}">
                                        {{ $valueNewProduct->product_name }}
                                    </a>
                                </div>
                                <div>
                                    <p class="item-description">
                                        {{ $valueNewProduct->description }}
                                    </p>
                                </div>
                            </div>
                            <a href="/detail&id={{ $valueNewProduct->id }}" style="color: wheat">
                                <div class="item-options text-center">
                                    <div class="cart">
                                        <i class="feather icon-shopping-cart"></i> <span>Chi tiết</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </section>
            <div style="text-align: center"><a type="button" href="/getNewProducts"
                    class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light" style="width: 200px">Xem
                    thêm</a></div>
        </div>
    </div>
    <div class="card-body">
        <div class="mt-4 mb-2 text-center">
            <h2>Ngẫu nhiên</h2>
            <p>Có thể bạn thích</p>
        </div>
        <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
            <div class="swiper-wrapper">
                @foreach ($newProduct as $valueRandomProduct)
                    <div class="swiper-slide rounded swiper-shadow">
                        <div class="item-heading">
                            <p class="text-truncate mb-0">
                                {{ $valueRandomProduct->product_name }}
                            </p>
                            <p>
                                <small>by</small>
                                <small>{{ $valueRandomProduct->supplier }}</small>
                            </p>
                        </div>
                        <div class="img-container w-50 mx-auto my-2 py-75">
                            <img src="{{ asset('img') }}/{{ $valueRandomProduct->image }}" style="height:159px; width: 121px !important" class="img-fluid" alt="image">
                        </div>
                        <div class="item-meta">
                            <div class="product-rating">
                                <i class="feather icon-star text-warning"></i>
                                <i class="feather icon-star text-warning"></i>
                                <i class="feather icon-star text-warning"></i>
                                <i class="feather icon-star text-warning"></i>
                                <i class="feather icon-star text-secondary"></i>
                            </div>
                            <p class="text-primary mb-0">{{ number_format($valueRandomProduct->unit_price) }} .Đ </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </div>
@endsection
