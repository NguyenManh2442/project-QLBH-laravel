<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrderManagementController extends Controller
{

    protected $order;
    protected $orderdetail;

    public function __construct(Orders $order, Orderdetail $orderdetail)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
    }
    // func orderManagement
    public function orderManagement(Request $request)
    {
        $status = 0;
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
        return view('order.show_all_orders', compact('orders'));
    }

    public function getOrderdetail($id)
    {
        $orderdetail = $this->orderdetail->getOrderdetail($id);
        $order = $this->order->getOrderByID($id);
        return view('order.orderdetail', compact('orderdetail', 'order'));
    }
}
