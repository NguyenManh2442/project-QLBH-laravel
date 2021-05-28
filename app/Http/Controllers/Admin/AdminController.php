<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use Illuminate\Http\Request;
use App\Http\Requests\signinAdmin;
use App\Http\Requests\CreateAccountAdminRequest;
use App\Http\Requests\UpdateInforAdminRequest;
use App\Models\Employee;
use App\Models\Orderdetail;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Models\Employee;
use Throwable;

class AdminController extends Controller
{
    protected $employee;
    protected $order;
    protected $orderdetail;

    public function __construct(Employee $employee, Orders $order, Orderdetail $orderdetail)
    {
        $this->employee = $employee;
        $this->order = $order;
        $this->orderdetail = $orderdetail;
    }

    // func index
    public function index(Request $request)
    {
        $array = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $data = $this->order->countProductOfMonth();
        foreach ($data as $value) {
            $array[$value->month - 1] = $value->quantity;
        }
        $count = array_map('intval', $array);
        $sellingProducts = $this->orderdetail->popularSellingProducts(5, $request);
        $sellingProductsByMonth = $this->orderdetail->popularSellingProductsByTime(5, 'month');
        $sellingProductsByYear = $this->orderdetail->popularSellingProductsByTime(5, 'year');

        $ordersPendingApproval = $this->order->getOrdersByStatus(0);
        $ordersApproved = $this->order->getOrdersByStatus(1);
        $ordersShipping = $this->order->getOrdersByStatus(2);

        return view('admin.chart', compact(
            'count', 
            'sellingProducts', 
            'sellingProductsByMonth' , 
            'sellingProductsByYear',
            'ordersPendingApproval',
            'ordersApproved',
            'ordersShipping'
        ));
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
        if (Auth::guard('employee')->attempt($data) && (Auth::guard('employee')->user()->role == 1 || Auth::guard('employee')->user()->role == 2) && Auth::guard('employee')->user()->status == 1) {
            return redirect('admin');
        }
        else if (Auth::guard('employee')->attempt($data) && Auth::guard('employee')->user()->role == 3 && Auth::guard('employee')->user()->status == 1) {
            return redirect('shipper');
        }
        else {
            Auth::guard('employee')->logout();
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
        session()->flash('success', 'Cập nhật thông tin thành công!');
        return redirect()->back()->with('update-infor','Cập nhật thông tin thành công!');
        
    }

    public function updatePassword(ChangePassword $request)
    {
        $password =Auth::guard('employee')->user()->password;
        if(Hash::check($request->old_password, $password)){
            $this->employee->changePassword($request->new_password);
            return redirect()->back()->with('success','Thay đổi mật khẩu thành công!');
        }
        else{
            return redirect()->back()->with('error','Mật khẩu cũng không đúng!');
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
        return redirect()->route('admin.accountManagement')->with('success','Thêm mới thành công!');
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
            session()->flash('success', 'Update thành công!');
            return redirect()->route('admin.accountManagement');
        } catch (Throwable $exception) {
            session()->flash('error', 'Update thất bại!');
            return redirect()->route('admin.accountManagement');
        }
    }

    // func deleteAccountAdmin
    public function deleteAccountAdmin($id){
        $this->employee->deleteEmployee($id);
        session()->flash('success', 'Block thành công!');
        return redirect()->route('admin.accountManagement');
    }

}
