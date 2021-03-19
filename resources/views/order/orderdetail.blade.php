@extends('layout.layout_admin')
@section('title','Admin')
@section('content')
<section class="invoice-print mb-1">
    <div class="row">
        <div class="col-12 col-md-7 d-flex flex-column flex-md-row justify-content-end">
            <button class="btn btn-primary btn-print mb-1 mb-md-0"> <i class="feather icon-file-text"></i> Print</button>
            <button class="btn btn-outline-primary  ml-0 ml-md-1"> <i class="feather icon-download"></i> Download</button>
        </div>
    </div>
</section>
<!-- invoice functionality end -->
<!-- invoice page -->
<section class="card invoice-page">
    <div id="invoice-template" class="card-body">
        <!-- Invoice Recipient Details -->
        <div id="invoice-customer-details" class="row pt-2">
            <div class="col-sm-6 col-12 text-left">
                <h5>Recipient</h5>
                <div class="recipient-info my-2">
                    <p>{{ $order[0]->name }}</p>
                    <p>{{ $order[0]->detailed_address }}</p>
                    <p>{{ $order[0]->wards }}, {{ $order[0]->district }}, {{ $order[0]->province }}</p>
                </div>
                <div class="recipient-contact pb-2">
                    <p>
                        Order date:
                        {{ $order[0]->order_date }}
                    </p>
                    <p>
                        <i class="feather icon-phone"></i>
                        {{ $order[0]->phone_number }}
                    </p>
                </div>
            </div>
        </div>
        <!--/ Invoice Recipient Details -->

        <!-- Invoice Items Details -->
        <div id="invoice-items-details" class="pt-1 invoice-items-table">
            <div class="row">
                <div class="table-responsive col-12">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit price</th>
                                <th>Discount</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $countUnitProce = 0;
                                $countDiscount = 0;
                            @endphp
                            @foreach ($orderdetail as $value)
                                <tr>
                                    <td><img src="{{asset('img')}}/{{ $value->image }}" alt="Img placeholder"></td>
                                    <td>{{ $value->product_name }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->unit_price }}</td>
                                    <td>{{ $value->discount }}</td>
                                    <td>{{ $value->size }}</td>
                                </tr>
                                @php
                                    $countUnitProce += $value->unit_price;
                                    $countDiscount += $value->unit_price - $value->unit_price * ($value->discount / 100)
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="invoice-total-details" class="invoice-total-table">
            <div class="row">
                <div class="col-7 offset-5">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Thành tiền</th>
                                    <td>{{ number_format($countUnitProce) }} .Đ</td>
                                </tr>
                                <tr>
                                    <th>Giảm giá</th>
                                    <td>- {{ number_format($countUnitProce - $countDiscount) }} .Đ</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền:</th>
                                    <td>{{ number_format($countDiscount) }} .Đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-7 d-flex">
                            <form action="{{ route('update.status_order', $order[0]->id)}}" method="post">
                                @method('PUT')
                                <input type="submit" name="btn_confirm" class="btn btn-primary mb-1 mb-md-0" value="Xác nhận đơn" />
                            </form>
                            <form action="{{ route('update.status_order', $order[0]->id)}}" method="post">
                                @method('PUT')
                                <input type="submit" name="btn_cancel" class="btn btn-danger  ml-0 ml-md-1" value="Hủy đơn" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div id="invoice-footer" class="text-right pt-3">
            
        </div>
        <!--/ Invoice Footer -->

    </div>
</section>
<!-- invoice page end -->
@endsection