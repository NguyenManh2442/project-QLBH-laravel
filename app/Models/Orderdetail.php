<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orderdetail extends Model
{
    //
    protected $table = 'orderdetails';

    // func getOrderProducts
    public function getOrderdetail($orderID) {
        return Orderdetail::join('products','products.id','=','orderdetails.id_product')
                        ->select('orderdetails.*','products.image','products.product_name')
                        ->where('orderdetails.order_id','=',$orderID)
                        ->get();
    }

    //
    public function popularSellingProducts($limit, $request){
        $query = Orderdetail::join('products','products.id','=','orderdetails.id_product')
        ->join('orders','orders.id','=','orderdetails.order_id')
        ->groupBy('id_product')
        ->select('id_product','products.*',DB::raw('SUM(orderdetails.quantity) as selling'))
        ->whereNotIn('orders.status', [4, 5]);
    
        if(isset($request['order_by'])) {
            $query->orderBy('products.'.$request['order_by'], $request['sort_order']);
        } else {
            $query->orderBy('selling','DESC');
        }
        return $query->where('products.status', 1)->where('products.quantity','>', 0)->paginate($limit);
    }

    public function popularSellingProductsByTime($limit, $option)
    {
        $time = null;
        if ($option == 'year') {
            $time = Carbon::now()->format('Y');
        } else {
            $time = Carbon::now()->format('m');
        }
        $query = Orderdetail::join('products','products.id','=','orderdetails.id_product')
        ->join('orders','orders.id','=','orderdetails.order_id')
        ->groupBy('id_product')
        ->select('id_product','products.*',DB::raw('SUM(orderdetails.quantity) as selling'))
        ->whereNotIn('orders.status', [4, 5])
        ->orderBy('selling','DESC');
        if ($option == 'year') {
            $query->whereYear('orderdetails.created_at', '=', $time);
        } else {
            $query->whereMonth('orderdetails.created_at', '=', $time);
        }
        return $query->paginate($limit);
    }
}
