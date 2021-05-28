<?php

namespace App\Http\Controllers\Customer;

use App\Events\CustomerOrder;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Orderdetail;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderdetail;
    protected $order;
    protected $category;
    protected $product;

    public function __construct(Orderdetail $orderdetail, Orders $order, Category $category, Product $product)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->category = $category;
        $this->product = $product;
    }

    public function postOrderProduct()
    {
        $orderdetail = session()->get('cart');
        $countDiscount = session()->get('count');
        $data = [
            'status' => 'false',
        ];
        if ($orderdetail == true) {
            $this->order->storeOrderProduct($countDiscount);
            $orderByUser = $this->order->findOrderByUserID(); 
            $order = false;
                foreach ($orderdetail as $value) {
                    $orderId = $orderByUser[0]->id;
                    $idProduct = $value['id'];
                    $unitPrice = $value['gia'];
                    $quantity = $value['num'];
                    $discount = $value['discount'];
                    $size = $value['size'];
                    $order = $this->order->storeOrderdetail($orderId, $idProduct, $unitPrice, $quantity, $discount, $size);
                    $updateDiscountProduct = $this->product->minusQuantityProduct($idProduct, $quantity);
                }
                if ($order == true && $updateDiscountProduct == true) {
                    $data['status'] = 'true';
                    $mail = Auth::user()->email;
                    $order = $this->order->getOrderByID($orderByUser[0]->id);
                    $orderdetail = $this->orderdetail->getOrderdetail($order[0]->id);
                    $order = json_decode(json_encode($order), true);
                    $orderdetails = json_decode(json_encode($orderdetail), true);
                    
                    event(new CustomerOrder($order, $orderdetails, $mail));

                    session()->forget('cart');
                    session()->forget('idAddress');
                    session()->flash('success', 'Đặt hàng thành công!');
                    return response()->json($data);
                } else {
                    session()->flash('error', 'Đặt hàng thất bại!');
                    return response()->json($data);
                }
             }
        session()->flash('error', 'Đặt hàng thất bại!');
        return response()->json($data);
    }

    public function getOrdered($status)
    {
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $orders = $this->order->getOrdersByStatus($status);
        $products = $this->order->getOrderByUserIDAndStatus($status);
        return view('customer.ordered_of_customer', compact('orders','products', 'category', 'category1', 'status'));
    }

    public function updateOrderStatus($id, Request $request)
    {
        $orderdetails = $this->orderdetail->getOrderdetail($id);
        if (isset($request->btn_cancel)) {
            $this->order->updateStatusOrderByUserID($id, 5);
            foreach ($orderdetails as $orderdetail) {
                $this->product->plusQuantityProduct($orderdetail->id_product, $orderdetail->quantity);
            }
        } 
        if (isset($request->btn_reorder)) {
            $this->order->updateStatusOrderByUserID($id, 0);
            foreach ($orderdetails as $orderdetail) {
                $this->product->minusQuantityProduct($orderdetail->id_product, $orderdetail->quantity);
            }
        }
        
        return redirect()->route('order.ordered', 0);
    }

}
