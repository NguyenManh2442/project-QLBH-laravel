<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Slideshow;

class ProductController extends Controller
{
    protected $category;
    protected $orderdetail;
    protected $product;
    protected $slideshow;
    protected $order;
    protected $deliveryAddress;

    public function __construct(Category $category, Orderdetail $orderdetail, Orders $order, Product $product, Slideshow $slideshow, DeliveryAddress $deliveryAddress)
    {
        $this->category = $category;
        $this->orderdetail = $orderdetail;
        $this->product = $product;
        $this->slideshow =$slideshow;
        $this->order = $order;
        $this->deliveryAddress = $deliveryAddress;
    }

    public function index(){
        $popularSellingProducts = $this->orderdetail->popularSellingProducts(6);
        $productRandom = $this->product->getProductrandom();
        $newProduct = $this->product->getNewProduct();
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $slideshow = $this->slideshow->getSlide();
        return view('product.show_all', compact('category','category1','slideshow','productRandom','newProduct','popularSellingProducts'));
    }

    public function getproductbycatid(Request $request){
        $categoryID = $request->idProduct;
        $product = $this->product->getproductbycatid($categoryID);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_products', compact('product','category', 'category1', 'categoryID'));
    }

    public function getPopularSellingProducts(){
        $product = $this->orderdetail->popularSellingProducts(24);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.getProduct', compact('product','category', 'category1'));
    }

    public function getOne(Request $request){
        $product = $this->product->getDetail($request->id);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_details', compact('product','category', 'category1'));
    }
    public function getCart(){
        $userID = Auth::user()->id;
        $address = $this->deliveryAddress->getAddressByUserId($userID);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        session(['idAddress' => $address[0]->id]);
        return view('product.checkout_cart', compact('category', 'category1', 'address'));
    }

    public function searchProduct(Request $request){
        $search1 = $request->search;
        $search = $request->search.'%';
        $product = $this->product->getSearchProduct($search);
        return view('product.getProduct', compact('product','category', 'category1','search1'));
    }

    public function getProductSort(Request $request){
            if(isset($request->menuid)) {
                $product = $this->product->getProductSortByPrice($request->menuid, $request->depart);
            }else{
                $search = $request->search.'%';
                $product = $this->product->getSearchProductSortByPrice($search, $request->depart);
            }
            $pro_arr = array();
            foreach ($product as $key=>$value){
                $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image"=>$value->image, "unitPrice"=>$value->unitPrice);
            }
            return $pro_arr;
    }

    public function getProductLatest(Request $request){
        
        if (isset($request->menuid)) {
                $product = $product = $this->product->getProductLatest($request->menuid, $request->check);
        } else {
            $search = $request->search . '%';
            $product = $this->product->getSearchProductLatest($search, $request->check);
        }

        $pro_arr = array();
        foreach ($product as $key => $value) {
            $pro_arr[] = array("productName" => $value->productName, "id" => $value->id, "image" => $value->image, "unitPrice" => $value->unitPrice);
        }
        return $pro_arr;
    }

}
