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
        $this->deliveryAddress->storeAddress($request->all());
        return redirect('/infor');
    }

    public function editAddress(Request $request)
    {
        $address = $this->deliveryAddress->getAddressById($request->id);
        return response()->json($address);
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
        $this->deliveryAddress->deleteAddress($id);
        return redirect('/infor');
    }
}