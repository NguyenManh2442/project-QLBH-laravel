@extends('layout.layout_customer')
@section('title')
    Products
@endsection
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Shop</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">eCommerce</a>
                            </li>
                            <li class="breadcrumb-item active">Shop
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
    <div class="content-detached content-right">
        <div class="content-body">
            <!-- Ecommerce Content Section Starts -->
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">
                                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                    <span class="navbar-toggler-icon d-block d-lg-none"><i
                                            class="feather icon-menu"></i></span>
                                </button>
                                <div class="search-results">
                                    16285 results found
                                </div>
                            </div>
                            <div class="view-options">
                                <select class="price-options form-control" id="ecommerce-price-options">
                                    <option selected>Featured</option>
                                    <option value="1">Lowest</option>
                                    <option value="2">Highest</option>
                                </select>
                                <div class="view-btn-option">
                                    <button class="btn btn-white view-btn grid-view-btn active">
                                        <i class="feather icon-grid"></i>
                                    </button>
                                    <button class="btn btn-white list-view-btn view-btn">
                                        <i class="feather icon-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Ecommerce Content Section Starts -->
            <!-- background Overlay when sidebar is shown  starts-->
            <div class="shop-content-overlay"></div>
            <!-- background Overlay when sidebar is shown  ends-->

            <!-- Ecommerce Search Bar Starts -->
            <section id="ecommerce-searchbar">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <fieldset class="form-group position-relative">
                            <input type="text" class="form-control search-product" id="iconLeft5" placeholder="Search here">
                            <div class="form-control-position">
                                <i class="feather icon-search"></i>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </section>
            <!-- Ecommerce Search Bar Ends -->

            <!-- Ecommerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">
                @foreach ($product as $key => $value)
                    <div class="card ecommerce-card">
                        <div class="card-content">
                            <div class="item-img text-center">
                                <a href="/detail&id={{ $value->id }}">
                                    <img class="img-fluid" src="{{ asset('img') }}/{{ $value->image }}"
                                        alt="img-placeholder"></a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <div class="badge badge-primary badge-md">
                                            <span>4</span> <i class="feather icon-star"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="item-price">
                                            @if ($value->discount == 0)
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($value->unit_price) }}
                                                    .Đ</p>
                                                </br></br>
                                            @else
                                                <p class="text-primary font-medium-3 mr-1 mb-0">
                                                    {{ number_format($value->unit_price - $value->unit_price * ($value->discount / 100)) }}
                                                    .Đ</p>
                                                <p style="font-size: 15px !important; color: #626262;">
                                                    <del>{{ number_format($value->unit_price) }}<del>
                                                            .Đ</p>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                                <div class="item-name">
                                    <a href="/detail&id={{ $value->id }}">{{ $value->product_name }}</a>
                                    <p class="item-company">By <span class="company-name">{{ $value->supplier }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="item-description">
                                        {{ $value->description }}
                                    </p>
                                </div>
                            </div>
                            <a href="/detail&id={{ $value->id }}" style="color: wheat">
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
            <!-- Ecommerce Products Ends -->

            <!-- Ecommerce Pagination Starts -->
            <section id="ecommerce-pagination">
                <div class="row">
                    <div class="col-sm-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-2">
                                <li class="page-item prev-item"><a class="page-link" href="#"></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item" aria-current="page"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item next-item"><a class="page-link" href="#"></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
            <!-- Ecommerce Pagination Ends -->

        </div>
    </div>
    <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
            <!-- Ecommerce Sidebar Starts -->
            <div class="sidebar-shop" id="ecommerce-sidebar-toggler">

                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                    </div>
                </div>
                <span class="sidebar-close-icon d-block d-md-none">
                    <i class="feather icon-x"></i>
                </span>
                <div class="card">
                    <div class="card-body">
                        <div class="multi-range-price">
                            <div class="multi-range-title pb-75">
                                <h6 class="filter-title mb-0">Multi Range</h6>
                            </div>
                            <ul class="list-unstyled price-range" id="price-range">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="price-range" checked value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">All</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="price-range" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50"> &lt;=$10</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="price-range" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">$10 - $100</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="price-range" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">$100 - $500</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="price-range" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">&gt;= $500</span>
                                    </span>
                                </li>

                            </ul>
                        </div>
                        <!-- /Price Filter -->
                        <hr>
                        <!-- Categories Starts -->
                        <div id="product-categories">
                            <div class="product-category-title">
                                <h6 class="filter-title mb-1">Categories</h6>
                            </div>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="category-filter" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Cameras & Camcorders</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="category-filter" value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Car Electronics & GPS</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!-- Categories Ends -->
                        <hr>
                        <!-- Brands -->
                        <div class="brands">
                            <div class="brand-title mt-1 pb-1">
                                <h6 class="filter-title mb-0">Brands</h6>
                            </div>
                            <div class="brand-list" id="brands">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" value="false">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">
                                                Metra
                                            </span>
                                        </span>
                                        <span>591</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" value="false">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">HP</span>
                                        </span>
                                        <span>530</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" value="false">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">Apple</span>
                                        </span>
                                        <span>442</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Brand -->
                        <hr>
                        <!-- Clear Filters Starts -->
                        <div id="clear-filters">
                            <button class="btn btn-block btn-primary">CLEAR ALL FILTERS</button>
                        </div>
                        <!-- Clear Filters Ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
