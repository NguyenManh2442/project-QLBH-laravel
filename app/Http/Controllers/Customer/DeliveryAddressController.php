<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Models\DeliveryAddress;
use Illuminate\Http\Request;
use Throwable;

class DeliveryAddressController extends Controller
{
    protected $deliveryAddress;

    public function __construct(DeliveryAddress $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
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
}