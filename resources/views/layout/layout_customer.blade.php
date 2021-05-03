<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('css/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('css/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/extensions/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/extensions/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/extensions/toastr.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/css/plugins/extensions/noui-slider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/pages/app-ecommerce-shop.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/pages/app-ecommerce-details.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/plugins/extensions/toastr.css') }}">
    <!-- END: Page CSS-->
    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="horizontal-layout horizontal-menu content-detached-left-sidebar ecommerce-application navbar-floating footer-static  "
    data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="/">
                        <div class="brand-logo"></div> THÚY HẰNG
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                        <?php
                        $numberCart = 0;
                        $secionCart = session()->get('cart');
                        ?>
                        @if (isset($secionCart))
                            @foreach ($secionCart as $key => $value)
                                <?php $numberCart++; ?>
                            @endforeach
                        @endif
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                href="/cart"><i class="ficon feather icon-shopping-cart"></i><span
                                    class="badge badge-pill badge-primary badge-up"
                                    id="numberCart">{{ $numberCart }}</span></a>
                        </li>
                        @if (Auth::check())
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ Auth::user()->username }}</span><span class="user-status">Active</span></div>
                                    <span>
                                        @if (!empty(Auth::user()->avatar))
                                            <img class="round"
                                            src="{{ asset('img') }}/{{ isset(Auth::user()->avatar) ? Auth::user()->avatar : '' }}"
                                            alt="avatar" height="40" width="40">
                                        @else
                                            <i class="ficon feather icon-user"></i>
                                        @endif
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                        href="{{ route('infor') }}"><i class="feather icon-user"></i> Thông tin cá
                                        nhân</a>
                                    <a class="dropdown-item" href="{{ route('order.ordered', 0) }}"><i
                                            class="feather icon-check-square"></i> Đơn hàng</a><a class="dropdown-item"
                                        href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i
                                            class="feather icon-power"></i> Đăng xuất</a>
                                </div>
                            </li>
                        @else
                            <li class="dropdown dropdown-user nav-item">
                                <a class="nav-link dropdown-user-link" href="/signin">
                                    <span class="user-name text-bold-600">Đăng nhập </span>
                                    <span> <i class="ficon feather icon-user"></i></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
            role="navigation" data-menu="menu-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                            <div class="brand-logo"></div>
                            <h2 class="brand-text mb-0">Vuexy</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                                class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                                class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                                data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="dropdown nav-item active" data-menu="dropdown"><a class="nav-link" href="/"><i
                                class="feather icon-home"></i><span data-i18n="Dashboard">Home</span></a></li>
                    @foreach ($category as $key => $value)
                        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link"
                                data-toggle="dropdown"><i class="feather icon-package"></i><span
                                    data-i18n="Dashboard">{{ $value->category_name }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach ($category1 as $key)
                                    @if ($key->sub_category_id == $value->id)
                                        <li data-menu=""><a class="dropdown-item"
                                                href="/getproductbycatid/{{ $key->id }}" data-toggle="dropdown"
                                                data-i18n="Analytics"><i
                                                    class="feather icon-circle"></i>{{ $key->category_name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <!-- content-->
            @section('content')
            @show
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-shadow">
        <p class="clearfix blue-grey lighten-2 mb-0"><span
                class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a
                    class="text-bold-800 grey darken-2" href="https://www.facebook.com/nguyenmanh2442.nt/"
                    target="_blank">ManhNguyen,</a>Đã đăng ký Bản quyền</span><span
                class="float-md-right d-none d-md-block">Nguyen Tien Manh<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i
                    class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('css/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('css/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/extensions/wNumb.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/extensions/nouislider.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/extensions/swiper.min.js') }}"></script>
    <!--gio hang-->
    <script src="{{ asset('css/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('css/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('css/app-assets/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/scripts/pages/app-ecommerce-details.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/scripts/forms/number-input.js') }}"></script>
    <!-- END: Page JS-->
    @yield('scripts')

</body>
<!-- END: Body-->

</html>
