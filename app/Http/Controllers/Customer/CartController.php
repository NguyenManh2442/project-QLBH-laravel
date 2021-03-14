<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function addCart(Request $request)
    {
        $id = $request->id;
        $num = $request->num;
        $size = $request->size;
        if (isset($id) && isset($num) && isset($size)) {

            $data = $this->product->getProductById($id);
            $cart = $request->session()->get('cart');
                if (!isset($cart)) {
                    $cart = array();
                    $cart[$id] = array(
                        'id' => $id,
                        'name' => $data->product_name,
                        'num' => $num,
                        'size' => $size,
                        'gia' => $data->unit_price,
                        'image' => $data->image,
                        'supplier' => $data->supplier,
                        'discount' => $data->discount,
                    );
                } else {
                    if (array_key_exists($id, $cart)) {
                        $cart[$id] = array(
                            'id' => $id,
                            'name' => $data->product_name,
                            'num' => (int)$cart[$id]['num'] + $num,
                            'size' => $size,
                            'gia' => $data->unit_price,
                            'image' => $data->image,
                            'supplier' => $data->supplier,
                            'discount' => $data->discount,
                        );
                    } else {
                        $cart[$id] = array(
                            'id' => $id,
                            'name' => $data->product_name,
                            'num' => $num,
                            'size' => $size,
                            'gia' => $data->unit_price,
                            'image' => $data->image,
                            'supplier' => $data->supplier,
                            'discount' => $data->discount,
                        );
                    }
                }
            $request->session()->put('cart', $cart);

            $numberCart = 0;
            foreach ($cart as $key => $value) {
                $numberCart++;
            }
            echo $numberCart;
        }
    }
    public function updateCart(Request $request)
    {
        $id = $request->id;
        $num = $request->num;
        $size = $request->size;
        if (isset($id) && isset($num) && isset($size)) {
            $cart = $request->session()->get('cart');
            if (array_key_exists($id, $cart)) {
                if ($num > 0) {

                    $cart[$id] = array(
                        'id' => $id,
                        'name' => $cart[$id]['name'],
                        'num' => $num,
                        'size' => $size,
                        'gia' => $cart[$id]['gia'],
                        'image' => $cart[$id]['image'],
                        'supplier' => $cart[$id]['supplier'],
                        'discount' => $cart[$id]['discount'],
                    );
                } else {
                    unset($cart[$id]);
                }
                $request->session()->put('cart', $cart);
            }
        }
    }
}
