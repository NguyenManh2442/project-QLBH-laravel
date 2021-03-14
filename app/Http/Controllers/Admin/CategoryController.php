<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Throwable;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    // func showMenuManager
    public function showMenuManager()
    {
        $category = $this->category->getCategoryParent(0);
        $subCategory = $this->category->getCategoryChill();
        return view('category.show_category', compact('category','subCategory'));
    }

    // func createCategory
    public function createCategory() {
        $category = $this->category->getCategoryParent(0);
        return view('category.form_category', compact('category'));
    }

    // func storeCategory
    public function storeCategory(CategoryRequest $request) {
        try {
            $this->category->storeCategory($request->all());
        } catch (Throwable $exception) {
            flash('Thêm mới thất bại!')->error();
            return redirect()->route('category.categoryManagement');
        }
        flash('Thêm mới thành công!')->success();
        return redirect()->route('category.categoryManagement');
    }

    // func editCategory
    public function editCategory($id)
    {
        $categoryById = $this->category->getCategory('id',$id);
        $category = $this->category->getCategoryParent(0);
        return view('category.form_category', compact('categoryById','category'));
    }

    // func updateCategory
    public function updateCategory($id, CategoryRequest $request){
        try {
            $this->category->updateCategory($id, $request->all());
        } catch (Throwable $exception) {
            flash('Update thất bại!')->error();
            return redirect()->route('category.categoryManagement');
        }
        flash('Update thành công!')->success();
        return redirect()->route('category.categoryManagement');
    }

    // func deleteCategory
    public function deleteCategory($id) {
        try {
            $this->category->deleteCategory($id);
        } catch (Throwable $exception) {
            flash('Xóa thất bại!')->error();
            return redirect()->route('category.categoryManagement');
        }
        flash('Xóa thành công!')->success();
        return redirect()->route('category.categoryManagement');
    }
}
