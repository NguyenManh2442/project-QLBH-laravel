<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucher;

    public function __construct(Vouchers $voucher)
    {
        $this->voucher = $voucher;
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
            $sName = $request->s_name;
            $sStatus= $request->s_status;
            if (isset($sName)) {
                $keySearch['name'] = $sName;
            }
            if (isset($sStatus)) {
                $keySearch['status'] = $sStatus;
            }
        }
        $vouchers = $this->voucher->getAll($keySearch);
        return view('voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voucher.form_voucher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        $this->voucher->storeVoucher($request->all());
        session()->flash('success', 'Thêm mới voucher thành công!');
        return redirect()->route('vouchers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = $this->voucher->getVoucherByID($id);
        return view('voucher.form_voucher', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherRequest $request, $id)
    {
        $this->voucher->updateVoucher($id, $request->all());
        session()->flash('success', 'Update slideshow thành công!');
        return redirect()->route('vouchers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->voucher->deleteVoucher($id);
        session()->flash('success', 'Xóa slideshow thành công!');
        return redirect()->route('vouchers.index');
    }
}
