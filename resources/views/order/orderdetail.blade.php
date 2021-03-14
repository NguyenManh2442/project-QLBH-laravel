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
                            @foreach ($orderdetail as $value)
                                <tr>
                                    <td><img src="{{asset('img')}}/{{ $value->image }}" alt="Img placeholder"></td>
                                    <td>{{ $value->product_name }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->unit_price }}</td>
                                    <td>{{ $value->discount }}</td>
                                    <td>{{ $value->size }}</td>
                                </tr>
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
                                    <th>SUBTOTAL</th>
                                    <td>114000 USD</td>
                                </tr>
                                <tr>
                                    <th>DISCOUNT (5%)</th>
                                    <td>5700 USD</td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td>108300 USD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div id="invoice-footer" class="text-right pt-3">
            <p>Transfer the amounts to the business amount below. Please include invoice number on your check.
                <p class="bank-details mb-0">
                    <span class="mr-4">BANK: <strong>FTSBUS33</strong></span>
                    <span>IBAN: <strong>G882-1111-2222-3333</strong></span>
                </p>
        </div>
        <!--/ Invoice Footer -->

    </div>
</section>
<!-- invoice page end -->
@endsection