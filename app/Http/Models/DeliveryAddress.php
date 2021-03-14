<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    protected $table = 'delivery_address';

    public function getAddressByUserId($userID){
        return DeliveryAddress::where('user_id', $userID)->paginate(24);
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
}
