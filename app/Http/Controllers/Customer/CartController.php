<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addCart(Request $request){
        $id = $request->id;
        $num = $request->num;
        if (isset($id)&&isset($num)) {

            $data=\App\Product::where('id', $id)->get();
            $cart = $request->session()->get('cart');

            foreach($data as $key=>$value){

                if (!isset($cart)) {
                    $cart = array();
                    $cart[$id]= array(
                        'id'=>$id,
                        'name'=>$value->productName,
                        'num'=>$num,
                        'gia'=>$value->unitPrice,
                        'image'=>$value->image
                    );
                }
                else{
                    // $cart = $_SESSION["cart"];
                    if (array_key_exists($id, $cart)) {
                        $cart[$id]= array(
                            'id'=>$id,
                            'name'=>$value->productName,
                            'num'=>(int)$cart[$id]['num']+$num,
                            'gia'=>$value->unitPrice,
                            'image'=>$value->image
                        );
                    }
                    else{
                        $cart[$id]= array(
                            'id'=>$id,
                            'name'=>$value->productName,
                            'num'=>$num,
                            'gia'=>$value->unitPrice,
                            'image'=>$value->image
                        );
                    }
                }}
            $request->session()->put('cart',$cart);

            $numberCart=0;
            foreach ($cart as $key => $value) {
                $numberCart ++;
            }
            echo $numberCart;
        }

    }
    public function updateCart(Request $request){
        $id = $request->id;
        $num = $request->num;
        if (isset($id)&&isset($num)) {

            $cart = $request->session()->get('cart');
            if (array_key_exists($id, $cart)) {
                if ($num>0) {

                    $cart[$id]= array(
                        'name'=> $cart[$id]['name'],
                        'num'=>$num,
                        'gia'=>$cart[$id]['gia'],
                        'image'=>$cart[$id]['image']
                    );
                }
                else{
                    unset($cart[$id]);
                }

                $request->session()->put('cart',$cart);
            }
        }
    }
}
