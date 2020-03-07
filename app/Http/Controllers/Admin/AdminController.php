<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\repairMenu;
use Illuminate\Http\Request;
use App\Http\Requests\signinAdmin;
use App\Http\Requests\AccAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function form_signin(){
        return view('admin.signin');
    }
    public function signinAdmin(signinAdmin $request){
        $data = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth::guard('employee')->attempt($data)&&Auth::guard('employee')->user()->level==1){
            return redirect('admin');
        }
        else if(Auth::guard('employee')->attempt($data)&&Auth::guard('employee')->user()->level==3){
            return redirect('shipper');
        }
        else{
            return redirect('signinAdminForm');
        }
    }
    public function logoutAdmin(Request $request){
        Auth::guard('employee')->logout();
        return redirect('signinAdminForm');
    }

    public function AdminAccountManagement(){
        $employee = \App\Employee::all();
        return view('admin.AdminAccountManagement', compact('employee'));
    }

    public function createAccAdmin(){
        return view('admin.formCreateAcc');
    }

    public function AddAccAdmin(AccAdmin $request){
        $employee = new \App\Employee();
        $employee->employeeName = $request->fullName;
        $employee->email = $request->email;
        $employee->phone= $request->phone;
        $employee->password= bcrypt($request->password1);
        $employee->level= $request->level;
        $employee->save();
        return redirect()->back()->with('addAcc','Thêm tài khoản thành công!');
    }

    public function deleteAcc(Request $request){
        \App\Employee::where('id',$request->id)->delete();
        return redirect()->back()->with('deleteAcc','Xóa tài khoản thành công!');
    }

    public function getCategoryParent(){

        return \App\Category::where('subCategoryID', '0')->get();
    }

    public function getCategoryChill(){
        return \App\Category::where('subCategoryID','!=', '0')->get();
    }

    public function showMenuManager(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('admin.showMenu', compact('category','category1'));
    }

    public function formRepairMenu(Request $request){
        $category = \App\Category::where('categoryID', $request->id )->get();
        $category1 = \App\Category::where('subCategoryID','!=', '0')->get();
        return view('admin.repairMenu', compact('category','category1'));
    }

    public function repairMenu(repairMenu $request){
        \App\Category::where('categoryID', $request->categoryID )->update(['categoryName'=>$request->CategoryParent]);
        \App\Category::where('categoryID', $request->categoryChillID1)->update(['categoryName'=>$request->CategoryChill1]);
        \App\Category::where('categoryID', $request->categoryChillID2)->update(['categoryName'=>$request->CategoryChill2]);
        return redirect()->back()->with('repairMenu','Sửa menu thành công');
    }

}
