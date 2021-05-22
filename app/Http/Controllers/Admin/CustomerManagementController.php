<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    protected $customer;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keySearch = [];
        if ($request->input('btn_search')) {
            $sEmail = $request->s_email;
            $sUsername = $request->s_username;
            $sStatus= $request->s_status;
            $sFullName = $request->s_full_name;

            if (isset($sEmail)) {
                $keySearch['email'] = $sEmail;
            }
            if (isset($sUsername)) {
                $keySearch['username'] = $sUsername;
            }
            if (isset($sStatus)) {
                $keySearch['status'] = $sStatus;
            }
            if (isset($sFullName)) {
                $keySearch['full_name'] = $sFullName;
            }
        }
        $customers = $this->customer->getAllUser($keySearch);
        return view('admin.customer_account_management', compact('customers'));
    }

    public function changeStatus($id) 
    {
        $this->customer->changeStatus($id);
        session()->flash('success', 'Thay đổi trạng thái thành công!');
        return redirect()->route('admin.customerAccountManagement');
    }
}
