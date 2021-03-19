<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Orderdetail;
use App\Models\Orders;
use App\Models\Product;
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

    public function postOrderProduct(Request $request)
    {
        $orderdetail = session()->get('cart');
        $data = [
            'status' => 'false',
        ];
        if ($orderdetail == true) { 
            $this->order->storeOrderProduct();
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
                    $updateDiscountProduct = $this->product->updateQuantityProductByID($idProduct, $quantity);
                }
                if ($order == true && $updateDiscountProduct == true) {
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

    public function getOrdered($status)
    {
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $products = $this->order->getOrderByUserIDAndStatus($status);
        return view('customer.ordered_of_customer', compact('products', 'category', 'category1', 'status'));
    }

}
