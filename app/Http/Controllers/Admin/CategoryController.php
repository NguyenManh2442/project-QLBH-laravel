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
            session()->flash('success', 'Thêm mới thành công!');
            return redirect()->route('category.categoryManagement');
        } catch (Throwable $exception) {
            session()->flash('error', 'Thêm mới thất bại!');
            return redirect()->route('category.categoryManagement');
        }
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
            session()->flash('success', 'Update thành công!');
        } catch (Throwable $exception) {
            session()->flash('error', 'Update thất bại!');
        }
        return redirect()->route('category.categoryManagement');
    }

    // func deleteCategory
    public function deleteCategory($id) {
        try {
            $this->category->deleteCategory($id);
            session()->flash('success', 'Delete thành công!');
        } catch (Throwable $exception) {
            session()->flash('error', 'Delete thất bại!');
        }
        return redirect()->route('category.categoryManagement');
    }
}
