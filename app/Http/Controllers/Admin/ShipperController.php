<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\User;
use App\Models\Orders;
use App\Models\Shipper;


class ShipperController extends Controller
{
    protected $employee;
    protected $customer;
    protected $order;

    public function __construct(Employee $employee, User $customer, Orders $order)
    {
        $this->employee = $employee;
        $this->customer = $customer;
        $this->order = $order;
    }
    public function index()
    {
        // $order = $this->customer->getOrderByCustomer();
        return view('shipper.chart');
    }

    public function getOrderByStatus($status, $request)
    {
        $keySearch = [];
        if ($request->input('btn_search')) {
            $sName = $request->s_name;
            $sPhone = $request->s_phone;
            $sDetailedAddress = $request->s_detailed_address;
            $sWards = $request->s_wards;
            $sDistrict = $request->s_district;
            $sProvince = $request->s_province;
            $sOrderDate = $request->s_order_date;

            if (isset($sName)) {
                $keySearch['name'] = $sName;
            }
            if (isset($sPhone)) {
                $keySearch['phone_number'] = $sPhone;
            }
            if (isset($sDetailedAddress)) {
                $keySearch['detailed_address'] = $sDetailedAddress;
            }
            if (isset($sWards)) {
                $keySearch['wards'] = $sWards;
            }
            if (isset($sDistrict)) {
                $keySearch['district'] = $sDistrict;
            }
            if (isset($sProvince)) {
                $keySearch['province'] = $sProvince;
            }
            if (isset($sOrderDate)) {
                $keySearch['order_date'] = $sOrderDate;
            }
        }
        $orders = $this->order->getOrders($keySearch, $status);
        return $orders;
    }

    // func receivePurchaseOrder
    public function receivePurchaseOrder(Request $request)
    {
        $status = 1;
        $orders = $this->getOrderByStatus($status, $request);
        return view('shipper.order', compact('orders', 'status'));
    }

    public function updateStatusOrder($id, Request $request)
    {
        if (isset($request->btn_finish)) {
            $shipperID = Auth::guard('employee')->user()->id;
            $this->order->updateStatusOrderAndShiperId($id, 3, $shipperID);
        } else {
            $shipperID = Auth::guard('employee')->user()->id;
            $this->order->updateStatusOrderAndShiperId($id, 2, $shipperID);
        }
        
        return redirect()->route('shipper.receive_purchase_order');
    }

    public function orderShipping(Request $request)
    {
        $status = 2;
        $orders = $this->getOrderByStatus($status, $request);
        return view('shipper.order', compact('orders', 'status'));
    }

    public function orderShipped(Request $request)
    {
        $status = 3;
        $orders = $this->getOrderByStatus($status, $request);
        return view('shipper.order', compact('orders', 'status'));
    }

    //
    public function getOrderLoadMoreShipper(Request $request){
        $order = DB::table('customers')
            ->join('orders', 'orders.userid', '=', 'customers.id')
            ->select('customers.address','customers.phone', 'customers.fullName', 'orders.*')
            ->orderBy('orders.orderDate', 'desc')
            ->where('orders.orderDate', '<', $request->lastid)
            ->where('orders.status',1)
            ->limit(3)
            ->get();
        $output = "";

        foreach ($order as $key => $value) {
            if (isset($value)){
                $output .= " <tr>
            <th scope=\"row\">$value->orderID</th>
            <td>$value->address</td>
            <td>$value->fullName</td>
            <td>$value->phone </td>";

                $output .= "<td><a class=\"btn btn-facebook\" href=\"orderdetail&orderId={{ $value->orderID }}\">Nhận đơn</a></td>
                </tr>";
            }
        }
        if (isset($value))
            $output .= "
                 <tr id='btnLoadMore'>
                     <td scope=\"row\">
                            <button class=\"btn btn-info load-more\" id=\"btnLoad1\" data-id=\"$value->orderDate\">Xem thêm...</button>
                     </td>
                 </tr>";
        echo $output;

    }
    public function reserve(Request $request){
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $id = Auth::guard('employee')->user()->id;

        $this->order->updateStatusOrderAndShiperId($request->orderId, 2, $id);
        
        $shipper = new Shipper();
        $shipper->shipperID = $id;
        $shipper->orderID = $request->orderId;
        $shipper->receiveDate = $time;
        $shipper->save();
        return redirect()->back()->with('reserve','Nhận đơn hàng thành công!');
    }

    public function receivedDelivery(){
        $id = Auth::guard('employee')->user()->id;
        $shipper = DB::table('shippers')
            ->join('orders','orders.orderID','=','shippers.orderID')
            ->join('customers','customers.id','=','orders.userId')
            ->select('customers.address','customers.phone','customers.fullName','shippers.orderID','shippers.receiveDate')
            ->where('shippers.shipperID',$id)
            ->where('orders.status',2)
            ->get();
        return view('productManagement.receivedDelivery', compact('shipper'));
    }

    public function completeOrder(Request $request){
        $completeOrderDate = Carbon::now('Asia/Ho_Chi_Minh');
        $id = Auth::guard('employee')->user()->id;
        Orders::where('orderID', $request->orderId)->update(['status' => 3]);
        Shipper::where('shipperID', $id)->where('orderID', $request->orderId)->update(['completeOrderDate' => $completeOrderDate]);

        return redirect()->back()->with('complete','Đơn hàng đã hoàn thành');
    }

    public function completeReserve(){
        $id = Auth::guard('employee')->user()->id;
        $shipper = DB::table('shippers')
            ->join('orders','orders.orderID','=','shippers.orderID')
            ->join('customers','customers.id','=','orders.userId')
            ->select('customers.address','customers.phone','customers.fullName','shippers.orderID','shippers.completeOrderDate')
            ->where('shippers.shipperID',$id)
            ->where('orders.status',3)
            ->get();
        return view('productManagement.completeReserve', compact('shipper'));
    }
}
