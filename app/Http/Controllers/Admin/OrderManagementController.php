<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;

class OrderManagementController extends Controller
{

    protected $order;
    protected $orderdetail;
    protected $product;

    public function __construct(Orders $order, Orderdetail $orderdetail, Product $product)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->product = $product;
    }
    // func orderManagement
    public function orderManagement($status, Request $request)
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
        return view('order.show_all_orders', compact('orders', 'status'));
    }

    public function getOrderdetail($id)
    {
        $orderdetail = $this->orderdetail->getOrderdetail($id);
        $order = $this->order->getOrderByID($id);
        return view('order.orderdetail', compact('orderdetail', 'order'));
    }

    public function updateOrderStatus($id, Request $request)
    {
        if (isset($request->btn_cancel)) {
            $this->order->updateStatusOrder($id, 4);
            $orderdetails = $this->orderdetail->getOrderdetail($id);
            foreach ($orderdetails as $orderdetail) {
                $this->product->plusQuantityProduct($orderdetail->id_product, $orderdetail->quantity);
            }
        } else {
            $this->order->updateStatusOrder($id, 1);
        }
        
        return redirect()->route('order.management', 1);
    }
}
