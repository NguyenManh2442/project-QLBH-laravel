<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vouchers extends Model
{
    protected $table = 'vouchers';

    public function getAll(array $request) {
        $query = DB::table('vouchers');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if ($key == 'name') {
                    $query->where($key, 'like', '%' . $value . '%');
                } else {
                    $query->where($key, '=', $value);
                }
            }
        }
        return $query->paginate($this->perPage);
    }

    public function getVoucherByID($id)
    {
        return Vouchers::find($id);
    }

    public function storeVoucher(array $request)
    {
        $vouchers = new Vouchers();
        $vouchers->name = $request['name_voucher'];
        $vouchers->quantity = $request['quantity'];
        $vouchers->effective_date = $request['start_date'];
        $vouchers->expiration_date = $request['end_date'];
        $vouchers->discount = $request['discount'];
        $vouchers->status = 1;
        $vouchers->save();
        return true;
    }

    public function updateVoucher($id, array $request)
    {
        $vouchers = Vouchers::find($id);
        $vouchers->name = $request['name_voucher'];
        $vouchers->quantity = $request['quantity'];
        $vouchers->effective_date = $request['start_date'];
        $vouchers->expiration_date = $request['end_date'];
        $vouchers->discount = $request['discount'];
        $vouchers->save();
        return true;
    }

    public function deleteVoucher($id)
    {
        $vouchers = Vouchers::find($id);
        $vouchers->status = 0;
        $vouchers->save();
    }

    public function checkVoucher($voucher)
    {
        $now = Carbon::now();
        $voucher = Vouchers::where('name', '=', $voucher)
        ->whereDate('effective_date','<=', $now)
        ->whereDate('expiration_date','>=', $now)
        ->where('status', '=', 1)
        ->get();
        return $voucher;
    }

    public function updateQuantityVoucher($voucher, $newQuantity)
    {
        Vouchers::where('name', $voucher)->update(['quantity' => $newQuantity]);
    }
}
