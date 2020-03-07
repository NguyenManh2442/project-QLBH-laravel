<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipperController extends Controller
{
    //
    public function index(){
        $order = DB::table('customers')
            ->join('orders','orders.userid','=','customers.id')
            ->select('customers.address','customers.phone','customers.fullName','orders.*')
            ->orderBy('orders.orderDate', 'desc')
            ->where('orders.status',1)
            ->limit(3)
            ->get();
        return view('admin.index', compact('order'));
    }
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
        \App\Orders::where('orderID', $request->orderId)->update(['status' => 2],['shipperID'=>$id]);
        $shipper = new \App\Shipper();
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
        \App\Orders::where('orderID', $request->orderId)->update(['status' => 3]);
        \App\Shipper::where('shipperID', $id)->where('orderID', $request->orderId)->update(['completeOrderDate' => $completeOrderDate]);

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
