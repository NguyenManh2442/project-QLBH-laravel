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
    const CANCEL_FOR_ADMIN = 2;
    const CANCEL_FOR_CUSROMER = 3;


    // func get Orders
    public function getOrders(array $keySearch, $status)
    {
        $query = DB::table('orders')
        ->join('delivery_address','delivery_address.id','=','orders.delivery_address_id');

        if (!empty($keySearch)) {
            foreach ($keySearch as $key => $value) {
                if (isset($keySearch['phone_number'])) {
                    $query->where($key, '=', $value);
                } else{
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }
        }
        return $query->where('orders.status','=',$status)
                    ->select(
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

    public function updateStatusOrderAndShiperId($orderID, $status, $shiperId) {
        Orders::where('order_id', $orderID)->update(['status' => $status], ['shipper_id'=>$shiperId]);
    }

    public function storeOrderProduct()
    {
        $id = Auth::user()->id;
        $order = new Orders();
        $order->user_id = $id;
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh');
        $order->status = 0;
        $order->delivery_address_id = session()->get('idAddress');
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

    public function getOrderByUserIDAndStatus($status)
    {   
        $id = Auth::user()->id;
        return Orders::join('orderdetails','orderdetails.order_id','=','orders.id')
        ->join('products','products.id','=','orderdetails.id_product')
        ->where('orders.user_id', '=', $id)
        ->where('orders.status','=',$status)
        ->orderBy('order_date', 'desc')
        ->select(
            'orders.order_date',
            'orderdetails.unit_price',
            'orderdetails.quantity', 
            'orderdetails.discount',
            'orderdetails.size', 
            'products.image', 
            'products.product_name'
            )
        ->paginate(5);
    }
}
