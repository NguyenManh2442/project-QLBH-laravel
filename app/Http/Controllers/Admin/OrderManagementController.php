<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Vouchers;

class OrderManagementController extends Controller
{

    protected $order;
    protected $orderdetail;
    protected $product;
    protected $voucher;
    protected $employee;

    public function __construct(Orders $order, Orderdetail $orderdetail, Product $product, Vouchers $voucher, Employee $employee)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->product = $product;
        $this->voucher = $voucher;
        $this->employee = $employee;
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
        $voucher = null;
        $employee = null;
        if ($order[0]->voucher_id != null) {
            $voucher = $this->voucher->getVoucherByID($order[0]->voucher_id);
        }
        if ($order[0]->user_id != null) {
            $employee = $this->employee->getOnlyEmployee($order[0]->shipper_id);
        }
        return view('order.orderdetail', compact('orderdetail', 'order', 'voucher', 'employee'));
    }

    public function updateOrderStatus($id, Request $request)
    {
        if (isset($request->btn_cancel)) {
            $this->order->updateStatusOrder($id, 4);
            $orderdetails = $this->orderdetail->getOrderdetail($id);
            foreach ($orderdetails as $orderdetail) {
                $this->product->plusQuantityProduct($orderdetail->id_product, $orderdetail->quantity);
            }
            session()->flash('success', 'Hủy đơn hàng thành công!');
            return redirect()->route('order.management', 4);
        } else {
            $this->order->updateStatusOrder($id, 1);
            session()->flash('success', 'Xác nhận đơn hàng thành công!');
            return redirect()->route('order.management', 1);
        }
    }
}
