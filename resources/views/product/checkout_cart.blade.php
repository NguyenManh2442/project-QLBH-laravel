@extends('layout.layout_customer')
@section('content')

@section('title')
    Giỏ hàng
@endsection
<div class="content-header row">
    @php
        $tong = 0;
        $sessionCart = session()->get('cart');
    @endphp
    @if (isset($sessionCart) && $sessionCart == true  && Auth::check())
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Checkout</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">eCommerce</a>
                            </li>
                            <li class="breadcrumb-item active">Checkout
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
    <div class="icons-tab-steps checkout-tab-steps wizard-circle">
        <!-- Checkout Place order starts -->
        <h6><i class="step-icon step feather icon-shopping-cart"></i>Cart</h6>
        <fieldset class="checkout-step-1 px-0">
            <div>
                <section class="list-view product-checkout">
                    <div class="checkout-items">
                        @foreach ($sessionCart as $key => $value)
                            <div class="card ecommerce-card">
                                <div class="card-content">
                                    <div class="item-img text-center">
                                        <a href="/detail&id={{ $value['id'] }}">
                                            <img src="{{ asset('img') }}/{{ $value['image'] }}"
                                                alt="img-placeholder" width="250px" height="250px">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="item-name">
                                            <a href="/detail&id={{ $value['id'] }}">{{ $value['name'] }}</a>
                                            <span></span>
                                            <p class="item-company">By <span
                                                    class="company-name">{{ $value['supplier'] }}</span></p>
                                            <p class="stock-status-in">In Stock</p>
                                        </div>
                                        <div>
                                            <p class="quantity-title">Size: <span
                                                    id="size_id_{{ $key }}">{{ $value['size'] }}</span>
                                            </p>
                                        </div>
                                        <div class="item-quantity">
                                            <p class="quantity-title">Quantity</p>
                                            <div class="input-group quantity-counter-wrapper">
                                                <input type="number" value="{{ $value['num'] }}"
                                                    class="quantity-counter" id="quantity_{{ $key }}"
                                                    name="quantity_{{ $key }}"
                                                    onchange="updateCart({{ $key }})">
                                            </div>
                                        </div>
                                        <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                        <p class="offers">17% off 4 offers Available</p>
                                    </div>
                                    <div class="item-options text-center">
                                        <div class="item-wrapper">
                                            <div class="item-rating">
                                                <div class="badge badge-primary badge-md">
                                                    4 <i class="feather icon-star ml-25"></i>
                                                </div>
                                            </div>
                                            <div class="item-cost">
                                                <div id="listCart{{ $key }}">
                                                    <h6 class="item-price" id="cartx{{ $key }}">
                                                        {{ number_format($tien = $value['gia'] * $value['num']) }}
                                                        Đ
                                                    </h6>
                                                </div>
                                                <p class="shipping">
                                                    <i class="feather icon-shopping-cart"></i> Free Shipping
                                                </p>
                                            </div>
                                        </div>
                                        <div class="wishlist remove-wishlist">
                                            <a href="javascript:void(0)" onclick="deleteCart({{ $key }})">
                                                <i class="feather icon-x align-middle"></i> Remove
                                            </a>
                                        </div>
                                        <div class="cart remove-wishlist">
                                            <i class="fa fa-heart-o mr-25"></i> Wishlist
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $tong += $tien;
                            @endphp
                        @endforeach
                    </div>
                    <div class="checkout-options">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="detail-amt">
                                        <div id="total">
                                            <div class="price-details">
                                                <p>Price Details</p>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Giá tất cả sản phẩm:
                                                </div>
                                                <div class="detail-amt">
                                                    ${{ number_format($tong) }} Đ
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Ship
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    Free
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt total-amt">
                                                    <div class="total">
                                                        ${{ number_format($tong) }} Đ
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn btn-primary btn-block place-order">ĐỊA CHỈ ĐẶT HÀNG</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </fieldset>
        <!-- Checkout Place order Ends -->

        <!-- Checkout Customer Address Starts -->
        <h6><i class="step-icon step feather icon-home"></i>Address</h6>
        <fieldset class="checkout-step-2 px-0">
            <section id="checkout-address" class="list-view product-checkout">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title">Thông tin giao hàng</h4>
                        <p class="text-muted mt-25">Hãy nhớ chọn "Gửi đến địa chỉ này" khi bạn đã hoàn tất
                        </p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive" id="data_address">
                                    <table class="table data-thumb-view" id="table_data_address">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($address))
                                            @foreach ($address as $key => $value)
                                                <tr id="data-{{ $value->id }}">
                                                    <td>
                                                        <fieldset>
                                                            <div class="vs-radio-con vs-radio-primary">
                                                                <input type="radio" name="address"
                                                                    value="{{ $value->id }}" @if ($key == 0) checked @endif>
                                                                <span class="vs-radio vs-radio-lg">
                                                                    <span class="vs-radio--border"></span>
                                                                    <span class="vs-radio--circle"></span>
                                                                </span>
                                                            </div>
                                                        </fieldset>
                                                    </td>
                                                    <td class="address-name" target="name">{{ $value->name }}</td>
                                                    <td class="address-phone" target="phone">
                                                        {{ $value->phone_number }}</td>
                                                    <td class="address-detailed-address" target="detailed-address">
                                                        {{ $value->detailed_address }} -
                                                        {{ $value->wards }} - {{ $value->district }} -
                                                        {{ $value->province }}</td>
                                                    <td class="product-action">
                                                        <span class="action-edit"
                                                            onclick="updateAddress({{ $value->id }})"
                                                            data-toggle="modal"
                                                            data-target="#editForm{{ $value->id }}"><i
                                                                class="feather icon-edit"></i></span>
                                                        <span class="action-delete" data-toggle="modal"
                                                            data-target="#danger{{ $value->id }}"><i
                                                                class="feather icon-trash"></i></span>
                                                        {{-- Model fake --}}
                                                        <div class="modal fade text-left"
                                                            id="editFake{{ $value->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel120"
                                                            aria-hidden="true">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action=""></form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Model edit --}}
                                                        <div class="modal fade text-left"
                                                            id="editForm{{ $value->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel130"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-info white">
                                                                        <h5 class="modal-title" id="myModalLabel130">
                                                                            Info Modal
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('address.update_address', $value->id) }}"
                                                                        method="post">
                                                                        @method('put')
                                                                        <div class="modal-body"
                                                                            id="info_address_{{ $value->id }}">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input class="btn btn-info" type="submit"
                                                                                value="Update" />
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal delete-->
                                                        <div class="modal fade text-left"
                                                            id="danger{{ $value->id }}" tabindex="-1" role="dialog"
                                                            aria-labelledby="myModalLabel120" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger white">
                                                                        <h5 class="modal-title" id="myModalLabel120">
                                                                            Cảnh báo
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn address này?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('slideshow.deleteSlideshow', $value->id) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            <input class="btn btn-danger" type="submit"
                                                                                value="Delete" />
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="customer-card">
                    <div class="card">
                        @if (isset($address))
                        <div class="card-header" id="confirm-name">
                            <h4 class="card-title" target="name">Tên: {{ $address[0]->name }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body actions" id="confirm-address">
                                <p class="mb-0"></p>
                                <p target="phone">Số điện thoại: {{ $address[0]->phone_number }}</p>
                                <p target="address">Địa chỉ: {{ $address[0]->detailed_address }} -
                                    {{ $address[0]->wards }} - {{ $address[0]->district }} -
                                    {{ $address[0]->province }}</p>
                                <hr>
                                <div class="btn btn-primary btn-block delivery-address">GỬI ĐẾN ĐỊA CHỈ NÀY</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        </fieldset>

        <!-- Checkout Customer Address Ends -->

        <!-- Checkout Payment Starts -->
        <h6><i class="step-icon step feather icon-credit-card"></i>Payment</h6>
        <fieldset class="checkout-step-3 px-0">
            <section id="checkout-payment" class="list-view product-checkout">
                <div class="payment-type">
                    <div class="card">
                        <div class="card-header flex-column align-items-start">
                            <h4 class="card-title">Payment options</h4>
                            <p class="text-muted mt-25">Be sure to click on correct payment option</p>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table data-thumb-view">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Size</th>
                                                <th>Tổng giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessionCart as $key => $value)
                                                <tr>
                                                    <td></td>
                                                    <td class="product-img"><img
                                                            src="{{ asset('img') }}/{{ $value['image'] }}"
                                                            alt="Img placeholder" width="250px" height="250px">
                                                    </td>
                                                    <td class="product-name">{{ $value['name'] }}</td>
                                                    <td class="product-category">{{ $value['num'] }}</td>
                                                    <td class="product-category">{{ $value['size'] }}</td>
                                                    <td class="product-category">
                                                        {{ number_format($tien = $value['gia'] * $value['num']) }} Đ
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="amount-payable checkout-options">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thanh toán</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="detail">
                                    <div class="details-title">
                                        Tổng tiền:
                                    </div>
                                    <div class="detail-amt">
                                        <strong>{{ number_format($tong) }} Đ</strong>
                                    </div>
                                </div>
                                <div class="detail">
                                    <div class="details-title">
                                        Người nhận:
                                    </div>
                                    <div class="detail-amt" target="name">
                                        {{ $address[0]->name }}
                                    </div>
                                </div>
                                <div class="detail">
                                    <div class="details-title">
                                        Số điện thoại:
                                    </div>
                                    <div class="detail-amt" target="phone">
                                        {{ $address[0]->phone_number }}
                                    </div>
                                </div>
                                <div class="detail">
                                    <div class="details-title">
                                        Địa chỉ:
                                    </div>
                                    <div class="detail-amt" target="address">
                                        {{ $address[0]->detailed_address }} - {{ $address[0]->wards }} -
                                        {{ $address[0]->district }} - {{ $address[0]->province }}
                                    </div>
                                </div>
                                <hr>
                                <div class="detail">
                                    <button class="btn btn-primary mr-1 mb-1" id="order"> Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </fieldset>

        <!-- Checkout Payment Starts -->
    </div>
    @endif
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/font_end/get_one.js') }}"></script>
@stop
