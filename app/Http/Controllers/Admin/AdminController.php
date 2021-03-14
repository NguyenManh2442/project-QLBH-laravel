<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\signinAdmin;
use App\Http\Requests\CreateAccountAdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Throwable;

class AdminController extends Controller
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    // func index
    public function index()
    {
        return view('admin.index');
    }

    // func formSignin
    public function formSignin()
    {
        return view('admin.signin');
    }

    // func signinAdmin
    public function signinAdmin(signinAdmin $request)
    {
        $data = [
            'mail_address'=> $request->email,
            'password'=> $request->password
        ];
        if (Auth::guard('employee')->attempt($data)&&Auth::guard('employee')->user()->role==1) {
            return redirect('admin');
        }
        else if (Auth::guard('employee')->attempt($data)&&Auth::guard('employee')->user()->role==3) {
            return redirect('shipper');
        }
        else {
            return redirect('signinAdminForm');
        }
    }

    // func logoutAdmin
    public function logoutAdmin(Request $request)
    {
        Auth::guard('employee')->logout();
        return redirect('signinAdminForm');
    }

    // func adminAccountManagement
    public function adminAccountManagement(Request $request)
    {
        $keySearch = [];
        if ($request->input('btn_search')) {
            $sName = $request->s_name;
            $sEmail = $request->s_email;
            $sRole = $request->s_role;
            $sPhone = $request->s_phone;
            if (isset($sName)) {
                $keySearch['name'] = $sName;
            }
            if (isset($sEmail)) {
                $keySearch['mail_address'] = $sEmail;
            }
            if (isset($sRole)) {
                $keySearch['role'] = $sRole;
            }
            if (isset($sPhone)) {
                $keySearch['phone'] = $sPhone;
            }
        }
        $employee = $this->employee->getAllEmployee($keySearch);
        return view('admin.AdminAccountManagement', compact('employee'));
    }

    // func createAccountAdmin
    public function createAccountAdmin()
    {
        return view('admin.form_create_acccount');
    }

    // func storeAccountAdmin
    public function storeAccountAdmin(CreateAccountAdminRequest $request){
        try {
            $this->employee->createEmployee($request->all());
        } catch (Throwable $exception) {
            flash('Thêm mới thất bại!')->error();
            return redirect()->route('admin.accountManagement');
        }
        flash('Thêm mới thành công!')->success();
        return redirect()->route('admin.accountManagement');

        return redirect()->back()->with('addAcc','Thêm tài khoản thành công!');
    }
    
    // func editAccountAdmin
    public function editAccountAdmin($id)
    {
        $employee = $this->employee->getOnlyEmployee($id);
        return view('admin.form_create_acccount', compact('employee'));
    }

    // func updateAccountAdmin
    public function updateAccountAdmin($id, CreateAccountAdminRequest $request){
        try {
            $this->employee->updateEmployee($id, $request->all());
        } catch (Throwable $exception) {
            flash('Them moi that bai!')->error();
            return redirect()->route('admin.accountManagement');
        }
        flash('Them moi thanh cong!')->success();
        return redirect()->route('admin.accountManagement');
    }

    // func deleteAccountAdmin
    public function deleteAccountAdmin($id){
        $this->employee->deleteEmployee($id);
        flash('Xoa thanh cong!')->success();
        return redirect()->route('admin.accountManagement');
    }

}
