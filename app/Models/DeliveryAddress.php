<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
{
    protected $table = 'delivery_address';

    public function getAddressByUserId($userID){
        return DeliveryAddress::where('user_id', $userID)->where('status', 0)->paginate(24);
    }

    public function getAddressById($id){
        return DeliveryAddress::find($id);
    }

    public function updateAddress($id, array $request)
    {
        $address = DeliveryAddress::find($id);
        $address->name = $request['name'];
        $address->phone_number = $request['phone'];
        $address->wards = $request['wards'];
        $address->district = $request['district'];
        $address->province = $request['province'];
        $address->detailed_address = $request['detailed_address'];
        $address->save();
        return true;
    }

    public function storeAddress(array $request)
    {
        $user_id = Auth::user()->id;
        $address = new DeliveryAddress;
        $address->user_id = $user_id;
        $address->name = $request['name'];
        $address->phone_number = $request['phone'];
        $address->wards = $request['wards'];
        $address->district = $request['district'];
        $address->province = $request['province'];
        $address->detailed_address = $request['detailed_address'];
        $address->status = 0;
        $address->save();
        return true;
    }

    public function deleteAddress($id)
    {
        $address = DeliveryAddress::find($id);
        $address->status = 1;
        $address->save();
    }
}
