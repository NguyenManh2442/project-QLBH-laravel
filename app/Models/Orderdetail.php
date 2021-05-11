<?php

namespace App\Models;

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
    public function popularSellingProducts($limit){
        return Orderdetail::join('products','products.id','=','orderdetails.id_product')
        ->groupBy('id_product')
        ->select('id_product','products.*',DB::raw('SUM(orderdetails.quantity) as selling'))
        ->orderBy('selling','DESC')
        ->paginate($limit);
    }
}
