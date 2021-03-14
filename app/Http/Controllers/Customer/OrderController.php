<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Orderdetail;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderController extends Controller
{
    protected $orderdetail;
    protected $order;

    public function __construct(Orderdetail $orderdetail, Orders $order)
    {
        $this->order = $order;
    }

    public function postOrderProduct(Request $request)
    {
        $orderdetail = session()->get('cart');
        $data = [
            'status' => 'false',
        ];
        if ($orderdetail == true) { 
            $this->order->storeOrderProduct();
            $orderByUser = $this->order->getOrderByUserID(); 
            $order = false;
                foreach ($orderdetail as $value) {
                    $orderId = $orderByUser[0]->id;
                    $idProduct = $value['id'];
                    $unitPrice = $value['gia'];
                    $quantity = $value['num'];
                    $discount = $value['discount'];
                    $size = $value['size'];
                    $order = $this->order->storeOrderdetail($orderId, $idProduct, $unitPrice, $quantity, $discount, $size);
                }
                if ($order == true) {
                    $data['status'] = 'true';
                    session()->forget('cart');
                    session()->forget('idAddress');
                    return response()->json($data);
                } else {
                    return response()->json($data);
                }
             }
        return response()->json($data);
    }

}
