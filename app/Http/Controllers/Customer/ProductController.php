<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateInfor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getCategoryParent(){

        return \App\Category::where('subCategoryID', '0')->get();
    }

    public function getCategoryChill(){
        return \App\Category::where('subCategoryID','!=', '0')->get();
    }
    public function getProductRandom(){
        return \App\Product::inRandomOrder()->limit(6)->get();
    }
    public function getNewProduct(){
        return \App\Product::limit(8)->get();
    }
    public function popularSellingProducts(){
            return \App\Orderdetail::select('idProduct','products.*',DB::raw('SUM(orderdetail.quantity) as banchay'))
            ->groupBy('idProduct')
            ->join('products','products.id','=','orderdetail.idProduct')
            ->orderBy('banchay','DESC')
            ->limit(6)->get();
    }
    public function index(){
        $popularSellingProducts = $this->popularSellingProducts();
        $productRandom = $this->getProductrandom();
        $newProduct = $this->getNewProduct();
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        $slideshow = $this->getSlide();
        return view('product.all', compact('category','category1','slideshow','productRandom','newProduct','popularSellingProducts'));
    }

    public function getSlide(){
        return \App\Slideshow::all();
    }


    public function getproductbycatid(Request $request){
       $categoryID = $request->idProduct;
       $product = \App\Product::where('categoryID', $categoryID)->paginate(24);
       $category= $this->getCategoryParent();
       $category1=$this->getCategoryChill();
        return view('product.getProduct', compact('product','category', 'category1', 'categoryID'));
    }

    public function getproductOffer(){
        $product = \App\Product::inRandomOrder()->paginate(24);
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();
        return view('product.getProduct', compact('product','category', 'category1'));
    }

    public function getPopularSellingProducts(){
        $product = \App\Orderdetail::select('idProduct','products.*',DB::raw('SUM(orderdetail.quantity) as banchay'))
            ->groupBy('idProduct')
            ->join('products','products.id','=','orderdetail.idProduct')
            ->orderBy('banchay','DESC')
            ->paginate(24);
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();
        return view('product.getProduct', compact('product','category', 'category1'));
    }

    public function getOne(Request $request){
        $product = \App\Product::where('id', $request->id)->get();
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();
        return view('product.get_one', compact('product','category', 'category1'));
    }
    public function getCart(){
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();
        return view('product.cart', compact('category', 'category1'));
    }

    public function searchProduct(Request $request){
        $search1 = $request->search;
        $search = $request->search.'%';
        $product = \App\Product::where('productName','like', $search)->paginate(24);
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();

        return view('product.getProduct', compact('product','category', 'category1','search1'));
    }

    public function dathang(UpdateInfor $request)
    {
        $cart = session()->get('cart');
        if ($cart==true){
            $tong = 0;
        $id = Auth::user()->id;
        $orderId = Auth::user()->username . "_" . rand(0, 2000);

        $order = new \App\Orders();
        $order->userId = $id;
        $order->orderID = $orderId;
        $order->orderDate = Carbon::now('Asia/Ho_Chi_Minh');
        $order->save();

        $orderId_2 = \App\Orders::where('userId', '=', $id)->get();
        $orderID2 = '';
        foreach ($orderId_2 as $key2 => $value2) {
            $orderID2 = $value2->orderID;
        }
        foreach ($cart as $key => $value) {
            $tien = $value['gia'] * $value['num'];
            $tong += $tien;
            $orderdetail = new \App\Orderdetail;
            $orderdetail->orderID = $orderID2;
            $orderdetail->idProduct = $value['id'];
            $orderdetail->unitPrice = $value['gia'];
            $orderdetail->quantity = $value['num'];
            $orderdetail->save();

        }
        $username = $request->username;
        $fullname = $request->fullName;
        $phone = $request->phone;
        $address = $request->address;
        $birthdate = $request->birthDate;

        $user = \App\User::find($id);
        $user->username = $username;
        $user->fullName = $fullname;
        $user->phone = $phone;
        $user->address = $address;
        $user->birthDate = $birthdate;
        $user->save();
        $request->session()->forget('cart');
        return redirect()->back()->with('dathang', 'Đặt đơn hàng thành công!');
    }else{
        return redirect()->back()->with('loidathang', 'Vui lòng chọn sản phẩm trước khi đặt!');
        }
    }

    public function orderProducts(){
        $id = Auth::user()->id;
        $orderProduct = DB::table('orders')
            ->join('orderdetail','orderdetail.orderID','=','orders.orderID')
            ->join('products','products.id','=','orderdetail.idProduct')
            ->select('orders.*','orderdetail.*','products.image','products.productName')
            ->orderBy('orders.orderDate', 'desc')
            ->where('orders.userId','=',$id)
            ->get();
        $category= $this->getCategoryParent();
        $category1=$this->getCategoryChill();
        return view('product.orderProduct', compact('orderProduct','category','category1'));

    }

    public function getProductSort(Request $request){
        if($request->depart==0){
            if(isset($request->menuid)) {
                $product = \App\Product::where('categoryID', $request->menuid)
                    ->orderBy('products.unitPrice', 'asc')
                    ->paginate(24);
            }else{
                $search = $request->search.'%';
                $product = \App\Product::where('productName','like', $search)
                    ->orderBy('products.unitPrice', 'asc')
                    ->paginate(24);
            }

            $pro_arr = array();
            foreach ($product as $key=>$value){
                $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image"=>$value->image, "unitPrice"=>$value->unitPrice);
            }
            return $pro_arr;
        }
        else if($request->depart==1){
            if(isset($request->menuid)) {
                $product = \App\Product::where('categoryID', $request->menuid)
                    ->orderBy('products.unitPrice', 'desc')
                    ->paginate(24);
            }else{
                $search = $request->search.'%';
                $product = \App\Product::where('productName','like', $search)
                    ->orderBy('products.unitPrice', 'desc')
                    ->paginate(24);
            }
            $pro_arr = array();
            foreach ($product as $key=>$value){
                $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image"=>$value->image, "unitPrice"=>$value->unitPrice);
            }
            return $pro_arr;
        }

    }

    public function getProductLatest(Request $request){
        if($request->check=='true') {
            if (isset($request->menuid)) {
                $product = \App\Product::where('categoryID', $request->menuid)
                    ->orderBy('products.created_at', 'desc')
                    ->paginate(24);
            } else {
                $search = $request->search . '%';
                $product = \App\Product::where('productName', 'like', $search)
                    ->orderBy('products.created_at', 'desc')
                    ->paginate(24);
            }

            $pro_arr = array();
            foreach ($product as $key => $value) {
                $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image" => $value->image, "unitPrice" => $value->unitPrice);
            }
            return $pro_arr;
        }elseif($request->check=='false'){
            if (isset($request->menuid)) {
                $product = \App\Product::where('categoryID', $request->menuid)
                    ->paginate(24);
            } else {
                $search = $request->search . '%';
                $product = \App\Product::where('productName','like', $search)->paginate(24);
            }

            $pro_arr = array();
            foreach ($product as $key => $value) {
                $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image" => $value->image, "unitPrice" => $value->unitPrice);
            }
            return $pro_arr;
        }
    }

}
