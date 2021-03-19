<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'customers';
    protected $fillable = [
        'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function postSignUp($email, $username, $password) {
        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->status = 1;
        $user->save();
    }

    public function postUpdateInfor($id, $username, $fullname, $phone, $address, $birthdate) {
        $user = User::find($id);
        $user->username = $username;
        $user->full_name = $fullname;
        $user->phone = $phone;
        $user->address = $address;
        $user->birth_date = $birthdate;
        $user->save();
    }

    public function changePassword($id, $newPassword) {
        $user = User::find($id);
        $user->password = bcrypt($newPassword);
        $user->save();
    }

    public function checkEmail($email) {
        return User::where('email', $email)->first();
    }

    public function checkUser($email, $token) {
        return User::where([
            'email'=>$email,
            'token'=>$token
        ])->first();
    }

    public function orderProcessing() {
        return User::join('orders','orders.user_id','=','customers.id')
            ->select('customers.phone','customers.full_name','orders.*')
            ->orderBy('orders.order_date', 'desc')
            ->limit(3)
            ->get();
    }

    public function dataOrder($orderId) {
        return User::join('orders','orders.user_id','=','customers.id')
            ->join('orderdetails','orderdetails.order_id','=','orders.order_id')
            ->join('products','products.id','=','orderdetails.id_product')
            ->select('customers.address','customers.phone','customers.full_name','customers.email','orders.*','orderdetails.*','products.image','products.product_name')
            ->where('orderdetails.order_id','=',$orderId)
            ->get();
            
    }

    public function getOrderByCustomer()
    {
        return User::join('orders','orders.user_id','=','customers.id')
            ->select('customers.address','customers.phone','customers.full_name','orders.*')
            ->orderBy('orders.order_date', 'desc')
            ->where('orders.status',1)
            ->get();
    }
}
