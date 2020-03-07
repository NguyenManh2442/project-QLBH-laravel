<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\AddProduct;
use Illuminate\Support\Facades\DB;

class ProductManagementController extends Controller
{
    //
    public function getCategoryParent(){

        return \App\Category::where('subCategoryID', '0')->get();
    }

    public function getCategoryChill(){
        return \App\Category::where('subCategoryID','!=', '0')->get();
    }

    public function getAllProduct(){
        return \App\Product::all();
    }

    public function viewProduct(){
        $product = $this->getAllProduct();
        return view('productManagement.allProduct', compact('product'));
    }
    public function formAddProduct(){
        $category1 = $this->getCategoryParent();
        return view('productManagement.addProduct', compact('category1'));
    }

    public function getCategoryAjax(Request $request){
        $categoryID = $request->depart;
        $categoryCon = \App\Category::where('subCategoryID','=', $categoryID)->get();
        $cate_arr = array();
        foreach ($categoryCon as $key=>$value){
            $cate_arr[] = array("categoryID" => $value->categoryID, "categoryName" => $value->categoryName);
        }
        return $cate_arr;

    }

    public function addProduct(AddProduct $request){
        if($request->hasFile('fileImg')){
            $time = Carbon::now('Asia/Ho_Chi_Minh');
            $fileImg = $request->fileImg;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();

            $fileImg->move('img', $fileName);
            $pro = new \App\Product();
            $pro->productName = $request->productName;
            $pro->categoryID = $request->menucon;
            $pro->unitPrice = $request->unitPrice;
            $pro->quantity = $request->quantity;
            $pro->description = $request->mota;
            $pro->image = $fileName;
            $pro->save();
            return redirect()->back()->with('themsp','Thêm sản phẩm thành công!');
        }
        else{
            return redirect()->back()->with('themsp','Thêm sản phẩm thất bại!');
        }
    }
    public function getAllMenu($categoryID){
        return \App\Category::where('categoryID',$categoryID)->get();
    }
    public function form_repair(Request $request){
        $category1 = $this->getCategoryParent();
        $product = \App\Product::where('id', $request->id)->get();

        foreach($product as $key =>$value){
            $categorycon = $this->getAllMenu($value->categoryID);
        }

        foreach($categorycon as $key =>$value2){
            $categorycha = $this->getAllMenu($value2->subCategoryID);
        }
        return view('productManagement.repairProduct', compact('category1','product','categorycon','categorycha'));
    }

    public function repairProduct(AddProduct $request){
        if($request->hasFile('fileImg')){
            $time = Carbon::now('Asia/Ho_Chi_Minh');
            $fileImg = $request->fileImg;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $id = $request->id;
            $fileImg->move('img', $fileName);
            $pro = \App\Product::find($id);
            $pro->productName = $request->productName;
            $pro->categoryID = $request->menucon;
            $pro->unitPrice = $request->unitPrice;
            $pro->quantity = $request->quantity;
            $pro->description = $request->mota;
            $pro->image = $fileName;
            $pro->save();
            return redirect()->back()->with('addsp','Sửa sản phẩm thành công!');
        }
        else{
            return redirect()->back()->with('addsp','Sửa sản phẩm thất bại!');
        }
    }

    public function orderProcessing(){

        $order = DB::table('customers')
            ->join('orders','orders.userid','=','customers.id')
            ->select('customers.phone','customers.fullName','orders.*')
            ->orderBy('orders.orderDate', 'desc')
            ->limit(3)
            ->get();
        return view('productManagement.orderProcessing', compact('order'));
    }

    public function dataOrder($orderId){
        return DB::table('customers')
            ->join('orders','orders.userid','=','customers.id')
            ->join('orderdetail','orderdetail.orderID','=','orders.orderID')
            ->join('products','products.id','=','orderdetail.idProduct')
            ->select('customers.address','customers.phone','customers.fullName','customers.email','orders.*','orderdetail.*','products.image','products.productName')
            ->where('orderdetail.orderID','=',$orderId)
            ->get();
    }
    public function orderdetail(Request $request){
        $ord = $this->dataOrder($request->orderId);

        return view('productManagement.orderdetail', compact('ord'));
    }

    public function orderConfirmation(Request $request){
        $ord = $this->dataOrder($request->orderID);
        foreach($ord as $key=> $value){
            $quant= \App\Product::where('id','=',$value->idProduct)->get();

            foreach ($quant as $key=>$quantitys){
                $newQuantity = $quantitys->quantity-$value->quantity;
                $pro = \App\Product::find($quantitys->id);
                $pro ->quantity = $newQuantity;
                $pro->save();
            }

            \App\Orders::where('orderID', $value->orderID)->update(['status' => 1]);
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

    public function orderCancel(Request $request){
//        dd($request);
        \App\Orders::where('orderID',$request->orderID)->update(['status'=>4]);
        return redirect()->back();
    }
}
