<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    //
    protected $table = 'orders';

    const CONFIRM = 1;
    const SHIPPING = 2;
    const SHIPPED = 3;
    const CANCEL_FOR_ADMIN = 4;
    const CANCEL_FOR_CUSROMER = 5;


    // func get Orders
    public function getOrders(array $keySearch, $status)
    {
        $query = DB::table('orders')
        ->join('delivery_address','delivery_address.id','=','orders.delivery_address_id');

        if ($status == 4) {
            $query->whereIn('orders.status', [4, 5]);
        } else {
            $query->where('orders.status','=',$status);
        }
        
        if (!empty($keySearch)) {
            foreach ($keySearch as $key => $value) {
                if ($key == 'phone_number') {
                    $query->where($key, '=', $value);
                } else {
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }
        }
        return $query->select(
                        'orders.*', 
                        'delivery_address.name',
                        'delivery_address.phone_number', 
                        'delivery_address.wards',
                        'delivery_address.district', 
                        'delivery_address.province', 
                        'delivery_address.detailed_address'
                        )
                    ->paginate(12);
    }

    public function getOrderByID($id)
    {
        return Orders::join('delivery_address','delivery_address.id','=','orders.delivery_address_id')
                    ->where('orders.id','=',$id)
                    ->select(
                        'orders.*', 
                        'delivery_address.name',
                        'delivery_address.phone_number', 
                        'delivery_address.wards',
                        'delivery_address.district',
                        'delivery_address.province',
                        'delivery_address.detailed_address'
                        )
                    ->get();
    }

    public function updateStatusOrder($orderID, $status) {
        Orders::where('id', $orderID)->update(['status' => $status]);
    }

    public function updateStatusOrderByUserID($orderID, $status) {
        $userID = Auth::user()->id;
        Orders::where('id', $orderID)->where('user_id', $userID)->update(['status' => $status]);
    }

    public function updateStatusOrderAndShiperId($orderID, $status, $shiperID) {
        try{
            $order = Orders::find($orderID);
            $order->shipper_id = $shiperID;
            $order->status = $status;
            $order->save();
        return true;
        }
        catch(Exception $exeption) {
            return false;
        }
    }

    public function storeOrderProduct($total_money)
    {
        $sessionVoucher = session()->get('voucher');
        $id = Auth::user()->id;
        $order = new Orders();
        $order->user_id = $id;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh');
        $order->status = 0;
        $order->total_money = $total_money;
        $order->delivery_address_id = session()->get('idAddress');
        if (isset($sessionVoucher)) {
            $order->voucher_id = $sessionVoucher["id"];
        }
        $order->save();
    }

    public function findOrderByUserID()
    {   
        $id = Auth::user()->id;
        return Orders::where('orders.user_id', '=', $id)
        ->orderBy('order_date', 'desc')
        ->limit(1)
        ->get();
    }

    public function storeOrderdetail($orderId, $idProduct, $unitPrice, $quantity, $discount, $size)
    {   DB::beginTransaction();
        try{
            $orderdetail = new Orderdetail;
            $orderdetail->order_id = $orderId;
            $orderdetail->id_product = $idProduct;
            $orderdetail->unit_price = $unitPrice;
            $orderdetail->quantity = $quantity;
            $orderdetail->discount = $discount;
            $orderdetail->size = $size;
            $orderdetail->save();
            DB::commit();
            return true;
        }
        catch(Exception $exeption) {
            DB::rollBack();
            return false;
        }
    }

    public function getOrdersByStatus($status)
    {
        $query = DB::table('orders');
        $query->join('delivery_address','delivery_address.id','=','orders.delivery_address_id')
                ->where('orders.status','=',$status);
                if ($status == 4) {
                    $query->orWhere('orders.status','=', 5);
                }
        return $query->select(
                    'orders.*', 
                    'delivery_address.name',
                    'delivery_address.phone_number', 
                    'delivery_address.wards',
                    'delivery_address.district', 
                    'delivery_address.province', 
                    'delivery_address.detailed_address'
                    )
                ->orderBy('orders.order_date','DESC')
                ->paginate(12);
    }

    public function getOrderByUserIDAndStatus($status)
    {   
        $id = Auth::user()->id;
        $query = DB::table('orders');
        $query->join('orderdetails','orderdetails.order_id','=','orders.id')
        ->join('products','products.id','=','orderdetails.id_product')
        ->where('orders.user_id', '=', $id)
        ->where('orders.status','=',$status);

        if ($status == 4) {
            $query->orWhere('orders.status','=', 5);
        }
        return $query->orderBy('order_date', 'desc')
                    ->select(
                        'orderdetails.order_id',
                        'orderdetails.unit_price',
                        'orderdetails.quantity', 
                        'orderdetails.discount',
                        'orderdetails.size', 
                        'products.image', 
                        'products.product_name'
                    )->get(5);
    }

    public function countProductOfMonth()
    {
        $year = Carbon::now()->format('Y');
        $data = Orders::join('orderdetails','orderdetails.order_id','=','orders.id')
        ->selectRaw('SUM(orderdetails.quantity) as quantity, MONTH(order_date) month')
        ->whereNotIn('status', [4, 5])
        ->whereYear('order_date', '=', $year)
        ->groupBy('month')
        ->get();
        return $data;
    }
}
