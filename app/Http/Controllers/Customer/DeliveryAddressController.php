<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Category;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;
use Throwable;

class DeliveryAddressController extends Controller
{
    protected $deliveryAddress;
    protected $category;

    public function __construct(DeliveryAddress $deliveryAddress, Category $category)
    {
        $this->deliveryAddress = $deliveryAddress;
        $this->category = $category;
    }

    public function createAddress()
    {
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.form_address', compact('category', 'category1'));
    }

    public function storeAddress(AddressRequest $request)
    {
        try {
            $this->deliveryAddress->storeAddress($request->all());
            session()->flash('success', 'Thêm địa chỉ thành công!');
            return redirect('/infor');
        } catch (Throwable $exception) {
            session()->flash('error', 'Thêm địa chỉ thất bại!');
            return redirect('/infor');
        }
    }

    public function editAddress(Request $request)
    {
        $address = $this->deliveryAddress->getAddressById($request->id);
        return response()->json($address);
    }

    public function editAddressByID($id)
    {
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $address = $this->deliveryAddress->getAddressById($id);
        return view('customer.form_address', compact('category', 'category1', 'address'));
    }

    public function updateAddressById($id, Request $request)
    {
        try {
            $this->deliveryAddress->updateAddress($id, $request->all());
            session()->flash('success', 'Update địa chỉ thành công!');
            return redirect('/infor');
        } catch (Throwable $exception) {
            session()->flash('error', 'Update địa chỉ thất bại!');
            return redirect('/infor');
        }
    }

    public function updateAddress($id, Request $request)
    {
        $data = [
            'status' => 'false',
        ];
        try {
            $this->deliveryAddress->updateAddress($id, $request->all());
        } catch (Throwable $exception) {
            return response()->json($data);
        }
        $address = $this->deliveryAddress->getAddressById($id);
        return response()->json($address);
    }

    public function storeAddressSession(Request $request)
    {;
        session(['idAddress' => $request->id]);
        $test = session()->get('idAddress');
        return response()->json($test);
    }

    public function deleteAddress($id)
    {
        try {
            $this->deliveryAddress->deleteAddress($id);
            session()->flash('success', 'Xóa địa chỉ thành công!');
            return redirect('/infor');
        } catch (Throwable $exception) {
            session()->flash('error', 'Xóa địa chỉ thất bại!');
            return redirect('/infor');
        }
    }
}