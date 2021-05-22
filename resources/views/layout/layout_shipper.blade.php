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
    <title>App Calender - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ asset('css/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('css/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/calendars/extensions/daygrid.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/calendars/extensions/timegrid.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">

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
        href="{{ asset('css/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/app-assets/css/plugins/calendars/fullcalendar.css') }}">

    <!-- END: Page CSS-->
    @yield('css')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static   menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        @if (Session::has('success'))
            <div id="alert-message" style="position: relative;">
                <div class="alert alert-success" role="alert" style="position: absolute; width: 400px; top: -32px;">
                    <h4 class="alert-heading">Success</h4>
                    <p class="mb-0">
                        {{ Session::get('success') }}
                    </p>
                </div>
            </div>
        @endif
        @if (Session::has('error'))
            <div id="alert-message" style="position: relative;">
                <div class="alert alert-danger" role="alert" style="position: absolute; width: 400px; top: -32px;">
                    <h4 class="alert-heading">Error</h4>
                    <p class="mb-0">
                        {{ Session::get('error') }}
                    </p>
                </div>
            </div>
        @endif
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i
                                        class="ficon feather icon-star warning"></i></a>
                                <div class="bookmark-input search-input">
                                    <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>
                                    <input class="form-control input" type="text" placeholder="Explore Vuexy..."
                                        tabindex="0" data-search="template-list">
                                    <ul class="search-list search-list-bookmark"></ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600">{{ Auth::guard('employee')->user()->name }}</span><span
                                        class="user-status">Active</span></div>
                                <span>
                                    @if (!empty(Auth::guard('employee')->user()->avatar))
                                        <img class="round"
                                            src="{{ asset('img') }}/{{ isset(Auth::guard('employee')->user()->avatar) ? Auth::guard('employee')->user()->avatar : '' }}"
                                            alt="avatar" height="40" width="40">
                                    @else
                                        <i class="ficon feather icon-user"></i>
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('shipper.edit_profile') }}"><i class="feather icon-user"></i> Edit
                                    Profile</a><a class="dropdown-item" href="app-email.html"><i
                                        class="feather icon-mail"></i> My
                                    Inbox</a><a class="dropdown-item" href="app-todo.html"><i
                                        class="feather icon-check-square"></i> Task</a><a class="dropdown-item"
                                    href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="/logoutAdmin"><i
                                        class="feather icon-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand"
                        href="../../../html/ltr/vertical-collapsed-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Thúy Hằng</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                            class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                            class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                            data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item {{ Request::segment(1) === 'shipper' ? 'active' : '' }}"><a href="/shipper"><i
                            class="feather icon-home"></i>
                        <span class="menu-title" data-i18n="Email">Thống kê</span></a>
                </li>
                <li class=" nav-item {{ Request::segment(1) === 'orderManagement&status=0' ? 'active' : '' }}"><a
                        href="{{ route('shipper.receive_purchase_order') }}"><i
                            class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Email">Nhận đơn
                            hàng</span></a>
                </li>
                <li class=" nav-item {{ Request::segment(1) === 'product-management' ? 'active' : '' }}"><a
                        href="{{ route('shipper.order_shipping') }}"><i class="fa fa-product-hunt"></i><span
                            class="menu-title" data-i18n="Chat">Đơn hàng đang giao</span></a>
                </li>
                <li class=" nav-item {{ Request::segment(1) === 'admin-account-management' ? 'active' : '' }}"><a
                        href="{{ route('shipper.order_shipped') }}"><i class="feather icon-users"></i><span
                            class="menu-title" data-i18n="Todo">Đơn hàng đã giao</span></a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'slideshow-management' ? 'active' : '' }}"><a
                        href="{{ route('slideshow.slideshowManagement') }}"><i class="feather icon-image"></i><span
                            class="menu-title">Quản lý
                            slideshow</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title"
                            data-i18n="Ecommerce">Quản lý ...</span></a>
                    <ul class="menu-content">
                        <li><a href="app-ecommerce-shop.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Shop">Quản lý</span></a>
                        </li>
                        <li><a href="app-ecommerce-details.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Details">Details</span></a>
                        </li>
                        <li><a href="app-ecommerce-wishlist.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Wish List">Wish List</span></a>
                        </li>
                        <li><a href="app-ecommerce-checkout.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Checkout">Checkout</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title"
                            data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a href="app-user-list.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="List">List</span></a>
                        </li>
                        <li><a href="app-user-view.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="View">View</span></a>
                        </li>
                        <li><a href="app-user-edit.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Edit">Edit</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>UI Elements</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title"
                            data-i18n="Data List">Data List</span><span
                            class="badge badge badge-primary badge-pill float-right mr-2">New</span></a>
                    <ul class="menu-content">
                        <li><a href="data-list-view.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="List View">List View</span></a>
                        </li>
                        <li><a href="data-thumb-view.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Thumb View">Thumb View</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-layout"></i><span class="menu-title"
                            data-i18n="Content">Content</span></a>
                    <ul class="menu-content">
                        <li><a href="content-grid.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Grid">Grid</span></a>
                        </li>
                        <li><a href="content-typography.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Typography">Typography</span></a>
                        </li>
                        <li><a href="content-text-utilities.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Text Utilities">Text Utilities</span></a>
                        </li>
                        <li><a href="content-syntax-highlighter.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Syntax Highlighter">Syntax Highlighter</span></a>
                        </li>
                        <li><a href="content-helper-classes.html"><i class="feather icon-circle"></i><span
                                    class="menu-item" data-i18n="Helper Classes">Helper Classes</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="colors.html"><i class="feather icon-droplet"></i><span class="menu-title"
                            data-i18n="Colors">Colors</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-eye"></i><span class="menu-title"
                            data-i18n="Icons">Icons</span></a>
                    <ul class="menu-content">
                        <li><a href="icons-feather.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Feather">Feather</span></a>
                        </li>
                        <li><a href="icons-font-awesome.html"><i class="feather icon-circle"></i><span class="menu-item"
                                    data-i18n="Font Awesome">Font Awesome</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- content-->
                @section('content')
                @show
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
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
    <script src="{{ asset('css/app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/calendar/extensions/daygrid.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/calendar/extensions/timegrid.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/calendar/extensions/interactions.min.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('css/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('css/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('css/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('css/app-assets/js/scripts/extensions/fullcalendar.js') }}"></script>
    <!-- END: Page JS-->
    @yield('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert-message').hide()
            }, 4000)
        })

    </script>

</body>
<!-- END: Body-->

</html>
