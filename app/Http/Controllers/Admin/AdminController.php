<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use Illuminate\Http\Request;
use App\Http\Requests\signinAdmin;
use App\Http\Requests\CreateAccountAdminRequest;
use App\Http\Requests\UpdateInforAdminRequest;
use App\Models\Employee;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Models\Employee;
use Throwable;

class AdminController extends Controller
{
    protected $employee;
    protected $order;

    public function __construct(Employee $employee, Orders $order)
    {
        $this->employee = $employee;
        $this->order = $order;
    }

    // func index
    public function index()
    {
        $array = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $data = $this->order->countProductOfMonth();
        foreach ($data as $value) {
            $array[$value->month - 1] = $value->quantity;
        }
        $count = array_map('intval', $array);
        return view('admin.chart', compact('count'));
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

    public function editProfile()
    {
        return view('admin.update_infor');
    }

    public function updateProfile(UpdateInforAdminRequest $request)
    {
        $fileName = null;
        if($request->hasFile('avatar')){
            $fileImg = $request->avatar;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);
        } else {
            $fileName = Auth::guard('employee')->user()->avatar;
        }

        $name = $request->full_name;
        $address = $request->address;
        $avatar = $fileName;
        $birthdate = $request->birth_date;
        $phone = $request->phone;
        $statusUpdate = $this->employee->postUpdateInfor($name, $address, $avatar, $birthdate, $phone);
        return redirect()->back()->with('update-infor','Cập nhật thông tin thành công!');
        
    }

    public function updatePassword(ChangePassword $request)
    {
        $password =Auth::guard('employee')->user()->password;
        if(Hash::check($request->old_password, $password)){
            $this->employee->changePassword($request->new_password);
            return redirect()->back()->with('thaymatkhau2','Thay đổi mật khẩu thành công!');
        }
        else{
            return redirect()->back()->with('thaymatkhau','Mật khẩu cũng không đúng!');
        }
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
