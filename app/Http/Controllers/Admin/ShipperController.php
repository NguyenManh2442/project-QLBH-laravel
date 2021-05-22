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
            session()->flash('success', 'Nhận đơn hàng thành công!');
        } else {
            $shipperID = Auth::guard('employee')->user()->id;
            $this->order->updateStatusOrderAndShiperId($id, 2, $shipperID);
            session()->flash('success', 'Đã hoàn thành đơn hàng!');
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

    public function editProfile()
    {
        return view('shipper.update_infor');
    }
}
