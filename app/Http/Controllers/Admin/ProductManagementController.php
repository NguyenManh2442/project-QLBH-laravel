<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DiscountProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Slideshow;
use App\Models\User;
use Throwable;

class ProductManagementController extends Controller
{
    protected $category;
    protected $orderdetail;
    protected $product;
    protected $slideshow;
    protected $order;
    protected $customer;

    public function __construct(User $customer, Category $category, Orderdetail $orderdetail, Orders $order, Product $product, Slideshow $slideshow)
    {
        $this->category = $category;
        $this->orderdetail = $orderdetail;
        $this->product = $product;
        $this->slideshow =$slideshow;
        $this->order = $order;
        $this->customer = $customer;
    }

    public function viewProduct(Request $request)
    {
        $keySearch = [];
        if ($request->input('btn_search')) {
            $sNameProduct = $request->s_name_product;
            $sStatus = $request->s_status;
            $sSupplier = $request->s_supplier;
            $sCategory = $request->s_category;
            if (isset($sNameProduct)) {
                $keySearch['product_name'] = $sNameProduct;
            }
            if (isset($sStatus)) {
                $keySearch['status'] = $sStatus;
            }
            if (isset($sSupplier)) {
                $keySearch['supplier'] = $sSupplier;
            }
            if (isset($sCategory)) {
                $keySearch['category_id'] = $sCategory;
            }
        }
        $product = $this->product->getAllProduct($keySearch);
        $category = $this->category->getCategoryParent(0);
        $subCategory = $this->category->getCategory('sub_category_id', $category[0]->id);
        return view('productManagement.allProduct', compact('product', 'category', 'subCategory'));
    }
    public function createProduct()
    {
        $category = $this->category->getCategoryParent(0);
        return view('productManagement.addProduct', compact('category'));
    }

    public function getCategoryAjax(Request $request)
    {
        $categoryID = $request->depart;
        $subCategory =  $this->category->getCategoryParent($categoryID);
        $cate_arr = array();
        foreach ($subCategory as $key => $value){
            $cate_arr[] = array("category_id" => $value->id, "category_name" => $value->category_name);
        }
        return $cate_arr;

    }

    public function storeProduct(CreateProductRequest $request)
    {
        if($request->hasFile('image')){
            $fileImg = $request->image;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);
            
            $productName = $request->product_name;
            $supplier = $request->supplier;
            $categoryId = $request->category_2;
            $unitPrice = $request->unit_price;
            $quantity = $request->quantity;
            $description = $request->description;
            $discount = $request->discount;
            $status = $request->status == true ? 1 : 0;
            $sizeS = isset($request->size_s) ? 1 : 0;
            $sizeM = isset($request->size_m) ? 1 : 0;
            $sizeL = isset($request->size_l) ? 1 : 0;
            $sizeXL = isset($request->size_xl) ? 1 : 0;
            $sizeXXL = isset($request->size_xxl) ? 1 : 0;
            $image = $fileName;

            try {
                $this->product->createProduct($productName, $supplier, $categoryId, $quantity, $unitPrice,  $discount, $status, $description, $image, $sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL);
            } catch (Throwable $exception) {
                flash('Thêm mới sản phẩm thất bại!')->error();
                session()->flash('error', 'Thêm mới sản phẩm thất bại!');
                return redirect()->route('product.management');
            }
            session()->flash('success', 'Thêm mới sản phẩm thành công!');
            return redirect()->route('product.management');
        }
        else{
            session()->flash('error', 'Thêm mới sản phẩm thất bại!');
            return redirect()->route('product.management');
        }
    }

    public function editProduct(Request $request){
        $category = $this->category->getCategoryParent(0);
        $product = $this->product->getProductById($request->id);
        $subCategoryById = $this->category->getCategory('id', $product->category_id);
        $subCategory = $this->category->getCategory('sub_category_id', $subCategoryById[0]->sub_category_id);
        return view('productManagement.addProduct', compact('product','subCategoryById', 'subCategory', 'category'));
    }

    // func updateProduct
    public function updateProduct(CreateProductRequest $request, $id) 
    {
        if ($request->hasFile('image')) {
            $fileImg = $request->image;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);
        } else {
            $fileName = null;
        }

        $productName = $request->product_name;
        $supplier = $request->supplier;
        $categoryId = $request->category_2;
        $unitPrice = $request->unit_price;
        $quantity = $request->quantity;
        $description = $request->description;
        $discount = $request->discount;
        $status = $request->status == true ? 1 : 0;
        $sizeS = isset($request->size_s) ? 1 : 0;
        $sizeM = isset($request->size_m) ? 1 : 0;
        $sizeL = isset($request->size_l) ? 1 : 0;
        $sizeXL = isset($request->size_xl) ? 1 : 0;
        $sizeXXL = isset($request->size_xxl) ? 1 : 0;
        $image = $fileName;

        try {
            $this->product->updateProduct($id, $productName, $supplier, $categoryId, $quantity, $unitPrice,  $discount, $status, $description, $image, $sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL);
        } catch (Throwable $exception) {
            session()->flash('error', 'Update sản phẩm thất bại!');
            return redirect()->route('product.management');
        }
        session()->flash('success', 'Update sản phẩm thành công!');
        return redirect()->route('product.management');
    }

    // func deleteProduct
    public function deleteProduct($id)
    {
        try {
            $this->product->destroyProduct($id);
        } catch (Throwable $exception) {
            session()->flash('error', 'Xóa sản phẩm thất bại!');
            return redirect()->route('product.management');
        }
        session()->flash('success', 'Xóa sản phẩm thành công!');
        return redirect()->route('product.management'); 
    }

    public function discountProducts()
    {
        $category = $this->category->getCategoryParent(0);
        return view('productManagement.discount_products', compact("category"));
    }

    public function setDiscountProducts(DiscountProductRequest $request)
    {
        $this->product->setDiscountProduct($request);
        session()->flash('success', 'Giảm giá sản phẩm thành công!');
        return redirect()->route('product.management');
    }
}
