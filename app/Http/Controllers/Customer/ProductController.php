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

    public function index(Request $request){
        if ($request->input('product_name') && isset($request->product_name)) {
            $product = $this->product->getSearchProduct($request);
            $category = $this->category->getCategoryParent(0);
            $category1 = $this->category->getCategoryChill();
        return view('product.show_products', compact('product','category', 'category1', 'categoryID'));
        }
        $popularSellingProducts = $this->orderdetail->popularSellingProducts(8, $request);
        $productRandom = $this->product->getProductrandom();
        $newProduct = $this->product->getNewProduct(8, $request);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $slideshow = $this->slideshow->getSlide();
        return view('product.show_all', compact('category','category1','slideshow','productRandom','newProduct','popularSellingProducts'));
    }

    public function getproductbycatid(Request $request){
        $product = $this->product->getproductbycatid($request);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_products', compact('product','category', 'category1', 'categoryID'));
    }

    public function getPopularSellingProducts(Request $request){
        $product = $this->orderdetail->popularSellingProducts(12, $request);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_products', compact('product','category', 'category1'));
    }

    public function getNewProducts(Request $request){
        $product = $this->product->getNewProduct(12, $request);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_products', compact('product','category', 'category1'));
    }

    public function getOne(Request $request){
        $product = $this->product->getDetail($request->id);
        $productbycategoryID = $this->product->getproductbycategoryID($product[0]->category_id);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('product.show_details', compact('product','category', 'category1', 'productbycategoryID'));
    }
    public function getCart(){
        if (Auth::check()) {
            $userID = Auth::user()->id;
            $address = $this->deliveryAddress->getAddressByUserId($userID);
            if ($address[0] != null) {
                session(['idAddress' => $address[0]->id]);
            }
        }
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        
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
