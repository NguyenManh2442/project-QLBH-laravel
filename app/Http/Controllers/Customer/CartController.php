<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Vouchers;

class CartController extends Controller
{
    protected $product;
    protected $voucher;
    public function __construct(Product $product, Vouchers $voucher)
    {
        $this->product = $product;
        $this->voucher = $voucher;
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

    public function checkVoucher(Request $request)
    {
        $data = array("status"=>"flase", "count_discount"=>"0");
        $orderdetail = session()->get('cart');
        if ($orderdetail == true) {
            $countDiscount = 0;
            foreach ($orderdetail as $value) {
                $countDiscount += ($value['gia'] - $value['gia'] * ($value['discount'] / 100)) * $value['num'];
            }
            $voucher = $this->voucher->checkVoucher($request->voucher);
            if ($voucher->count() == 1 && $voucher[0]->quantity > 0) {
                $countDiscount = $countDiscount - $countDiscount * ($voucher[0]->discount / 100);
                $data["status"] = "true";
                $data["count_discount"] = number_format($countDiscount);
                return $data;
            }
            $data["count_discount"] = number_format($countDiscount);
            return $data;
        }
        return $data;
    }

    public function confirmVoucher(Request $request)
    {
        $data = array("status"=>"flase");
        $orderdetail = session()->get('cart');
        $sessionVoucher = session()->get('voucher');
        if ($orderdetail == true) {
            $countDiscount = 0;
            foreach ($orderdetail as $value) {
                $countDiscount += ($value['gia'] - $value['gia'] * ($value['discount'] / 100)) * $value['num'];
            }
            $voucher = $this->voucher->checkVoucher($request->voucher);
            
            if ($voucher->count() == 1 && $voucher[0]->quantity > 0) {
                $vc = array("id" => $voucher[0]->id, "name" => $voucher[0]->name);
                $countDiscount = $countDiscount - $countDiscount * ($voucher[0]->discount / 100);
                $data["status"] = "true";
                session(['count' => $countDiscount]);
                if (!isset($sessionVoucher)) {
                    session()->put('voucher', $vc);
                    $this->voucher->updateQuantityVoucher($request->voucher, $voucher[0]->quantity - 1);
                } else {
                    session()->put('voucher', $vc);
                    $oldVoucher = $this->voucher->getVoucherByID($sessionVoucher['id']);
                    $this->voucher->updateQuantityVoucher($oldVoucher->name, $oldVoucher->quantity + 1);
                    $this->voucher->updateQuantityVoucher($request->voucher, $voucher[0]->quantity - 1);
                }
                return $data;
            }
            if (isset($sessionVoucher)) {
                $oldVoucher = $this->voucher->getVoucherByID($sessionVoucher['id']);
                $this->voucher->updateQuantityVoucher($oldVoucher->name, $oldVoucher->quantity + 1);
                $request->session()->forget('voucher');
            }
            session(['count' => $countDiscount]);
            return $data;
        }
        return $data;
    }
}
