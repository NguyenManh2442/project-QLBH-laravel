<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $perPage = 12;

    protected $fillable = [
        'product_name',
        'supplier',
        'category_id',
        'quantity',
        'unit_price',
        'discount',
        'status',
        'description',
        'image',
        'size_id',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    
    protected $table='products';

    public function getAllProduct(array $request) {
        $query = DB::table('products');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if ($key == 'product_name') {
                    $query->where($key, 'like', '%' . $value . '%');
                } else {
                    $query->where($key, '=', $value);
                }
            }
        }
        return $query->paginate($this->perPage);
    }

    public function getProductById($id) {
        return Product::find($id);
    }

    public function getProductRandom(){
        return Product::inRandomOrder()->limit(8)->get();
    }

    public function getNewProduct($limit, $request){
        $query = Product::orderBy('products.created_at', 'desc');
        
        if(isset($request['order_by'])) {
            $query->orderBy('products.'.$request['order_by'], $request['sort_order']);
        }
        return $query->where('status', 1)->where('products.quantity','>', 0)->paginate($limit);
    }

    public function getproductbycatid($request){
        $query = Product::where('category_id', $request->idProduct);
        if(isset($request->order_by)) {
            $query->orderBy($request->order_by, $request->sort_order);
        }
        
        return $query->where('status', 1)->where('products.quantity','>', 0)->paginate(12);
    }

    public function getproductbycategoryID($categoryID){
        $query = Product::where('category_id', $categoryID); 
        return $query->where('status', 1)->where('products.quantity','>', 0)->paginate(8);
    }

    public function getSearchProduct($request)
    {
        $query = Product::where('product_name','like', '%' . $request->product_name . '%');
        if(isset($request->order_by)) {
            $query->orderBy($request->order_by, $request->sort_order);
        }
        return $query->paginate(12);
    }
    public function getDetail($id) {
        return Product::where('id', $id)->get();
    }

    //
    public function updateQuantityProductByID($id, $quantity)
    {
        DB::beginTransaction();
        try{
            Product::where('id', $id)->update(['quantity' => $quantity]);
        DB::commit();
        return true;
        }
        catch(Exception $exeption) {
            DB::rollBack();
            return false;
        }
    }

    //
    public function minusQuantityProduct($id, $quantity)
    {
        $product = $this->getProductById($id);
        $quantity = $product->quantity - $quantity;
        return $this->updateQuantityProductByID($id, $quantity);
    }

    //
    public function plusQuantityProduct($id, $quantity)
    {
        $product = $this->getProductById($id);
        $quantity = $product->quantity + $quantity;
        return $this->updateQuantityProductByID($id, $quantity);
    }

    //
    public function getProductLatest($menuid, $check) {
        $query = $this->_model->newQuery()
        ->where('category_id', $menuid)
        ->orderBy('products.created_at', 'desc')
        ->paginate(24);
        if($check == 'true'){
            $query = $query->orderBy('products.created_at', 'desc');
        }
        return $query;
    }

    public function getSearchProductLatest($search, $check) {
        
        $query = $this->_model->newQuery()
        ->where('product_name', 'like', $search)
        ->paginate(24);
        if($check == 'true'){
            $query = $query->orderBy('products.created_at', 'desc');
        }
        return $query;
    }

    public function getProductSortByPrice($menuid, $sort) {
        $typeSort = 'asc';
        if($sort == 1) {
            $typeSort = 'desc';
        }
        $query = $this->_model->newQuery()
        ->where('category_id', $menuid)
        ->orderBy('products.unit_price', $typeSort)
        ->paginate(24);
        return $query;
    }

    public function getSearchProductSortByPrice($search, $sort){
        $typeSort = 'asc';
        if($sort == 1) {
            $typeSort = 'desc';
        }
        $query = $this->_model->newQuery()
        ->where('product_name','like', $search)
        ->orderBy('products.unit_price', $typeSort)
        ->paginate(24);
        return $query;
    }

    public function createProduct($productName, $supplier, $categoryId, $quantity, $unitPrice,  $discount, $status, $description, $image, $sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL) {
        $pro = new Product();
        $pro->product_name = $productName;
        $pro->supplier = $supplier;
        $pro->category_id = $categoryId;
        $pro->quantity = $quantity;
        $pro->unit_price = $unitPrice;
        $pro->discount = $discount;
        $pro->status = $status;
        $pro->description = $description;
        $pro->image = $image;
        $pro->size_s = $sizeS;
        $pro->size_m = $sizeM;
        $pro->size_l = $sizeL;
        $pro->size_xl = $sizeXL;
        $pro->size_xxl = $sizeXXL;
        $pro->save();
    }

    public function updateProduct($id, $productName, $supplier, $categoryId, $quantity, $unitPrice,  $discount, $status, $description, $image, $sizeS, $sizeM, $sizeL, $sizeXL, $sizeXXL) {
        $pro = Product::find($id);
        $pro->product_name = $productName;
        $pro->supplier = $supplier;
        $pro->category_id = $categoryId;
        $pro->quantity = $quantity;
        $pro->unit_price = $unitPrice;
        $pro->discount = $discount;
        $pro->status = $status;
        $pro->description = $description;
        if ($image != null) {
            $pro->image = $image;
        }
        $pro->size_s = $sizeS;
        $pro->size_m = $sizeM;
        $pro->size_l = $sizeL;
        $pro->size_xl = $sizeXL;
        $pro->size_xxl = $sizeXXL;
        $pro->save();
    }

    public function updateQuantity($id, $newQuantity) {
        $pro = Product::find($id);
        $pro ->quantity = $newQuantity;
        $pro->save();
    }

    // func delete product 
    public function destroyProduct($id) {
        Product::destroy($id);
    }

    public function setDiscountProduct($request) {
        Product::where('category_id', $request->category_2)->update(['discount'=>$request->discount]);
    }
}

