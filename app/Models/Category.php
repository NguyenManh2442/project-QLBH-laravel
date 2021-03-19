<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";

    public function getAllCategory() {
        return Category::all();
    }

    public function getCategoryParent($subCategoryId) {
        return Category::where('sub_category_id', $subCategoryId)->get();
    }

    public function getCategoryChill() {
        return Category::where('sub_category_id','!=', '0')->get();
    }
    
    public function getCategory($colum, $value) {
        return Category::where($colum, $value)->get();
    }

    public function storeCategory(array $request)
    {
        $subCategoryID = 0;
        $category = new Category();
        $category->category_name = $request['category_name'];
        if (isset($request['sub_category']) && $request['sub_category'] == true) {
            $subCategoryID = $request['category'];
        }
        
        $category->sub_category_id = $subCategoryID;
        $category->save();
        return true;
    }

    public function updateCategory($id, array $request) 
    {
        $subCategoryID = 0;
        $category = Category::find($id);
        $category->category_name = $request['category_name'];
        if (isset($request['sub_category']) && $request['sub_category'] == true) {
            $subCategoryID = $request['category'];
        }
        
        $category->sub_category_id = $subCategoryID;
        $category->save();
        return true;
    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
        return true;
    }
}
