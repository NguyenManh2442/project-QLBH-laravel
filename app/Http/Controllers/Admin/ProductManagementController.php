<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
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
                return redirect()->route('product.management');
            }
            flash('Thêm mới sản phẩm thành công!')->success();
            return redirect()->route('product.management');
        }
        else{
            flash('Thêm mới sản phẩm thất bại!')->error();
            return redirect()->route('product.management');
        }
    }

    public function editProduct(Request $request){
        $category = $this->category->getCategoryParent(0);
        $product = $this->product->getProductById($request->id);
        $subCategoryById = $this->category->getCategory('id', $product->category_id);
        $subCategory = $this->category->getCategory('sub_category_id', $category[0]->id);
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
            flash('Update sản phẩm thất bại!')->error();
            return redirect()->route('product.management');
        }
        flash('Update sản phẩm thành công!')->success();
        return redirect()->route('product.management');
    }

    // func deleteProduct
    public function deleteProduct($id)
    {
        try {
            $this->product->destroyProduct($id);
        } catch (Throwable $exception) {
            flash('Xóa sản phẩm thất bại!')->error();
            return redirect()->route('product.management');
        }
        flash('Xóa sản phẩm thành công!')->success();
        return redirect()->route('product.management'); 
    }

    public function orderConfirmation(Request $request){
        $ord =  $this->customer->dataOrder($request->orderId);
        foreach($ord as $key => $value){
            $quant= $this->product->getProductById($value->idProduct);

            foreach ($quant as $key => $quantitys){
                $newQuantity = $quantitys->quantity - $value->quantity;

                $this->product->updateQuantity($quantitys->id, $newQuantity);
            }

            $this->order->updateStatusOrder($value->orderID, 1);
        }
        return redirect()->back();
    }

    public function getOrderLoadMore(Request $request)
    {
        $order = DB::table('customers')
            ->join('orders', 'orders.userid', '=', 'customers.id')
            ->select('customers.phone', 'customers.fullName', 'orders.*')
            ->orderBy('orders.orderDate', 'desc')
            ->where('orders.orderDate', '<', $request->lastid)
            ->limit(3)
            ->get();
        $output = "";


            foreach ($order as $key => $value) {
                if (isset($value)){
                    $output .= " <tr>
            <th scope=\"row\">$value->orderID</th>
            <td>$value->orderDate</td>
            <td>$value->fullName</td>
            <td>$value->phone </td>";
                if ($value->status == '') {
                    $output .= " <td style='color: red'>Chưa xác nhận</td>";
                }
                elseif($value->status == 4){
                    $output .= " <td style='color: red'>Đã hủy</td>";
                }
                elseif($value->status == 2){
                    $output .= " <td style='color: #000080'>Shipper đã nhận</td>";
                }
                elseif($value->status == 3){
                    $output .= " <td style='color: green'>Đã giao thành công</td>";
                }
                else {
                    $output .= " <td style='color: #FFA500'>Đã xác nhận</td>";
                }
                $output .= "<td><a href=\"orderdetail&orderId=$value->orderID \"class=\"btn btn-info\">Xem chi tiết</a></td>
                </tr>";
            }
        }
            if (isset($value))
                $output .= "
                 <tr id='btnLoadMore'>
                     <td scope=\"row\">
                            <button class=\"btn btn-info load-more\" id=\"btnLoad2\" data-id=\"$value->orderDate\">Xem thêm...</button>
                     </td>
                 </tr>";
            echo $output;

    }

    public function orderCancel(Request $request)
    {
        $this->order->updateStatusOrder($request->orderID, 4);
        return redirect()->back();
    }
}
