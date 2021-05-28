<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function postUpdateInfor($username, $fullname, $avatar, $birthdate) {
        try {
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->username = $username;
            $user->full_name = $fullname;
            if ($avatar != null) {
                $user->avatar = $avatar;
            }
            $user->birth_date = $birthdate;
            $user->save();
            return true;
        }
        catch(Exception $exeption) {
            dd($exeption);
            return false;
        }
        
    }

    public function changePassword($new_password) {
        try {
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = bcrypt($new_password);
            $user->save();
            return true;
        }
        catch(Exception $exeption) {
            return false;
        }
    }

    public function checkEmail($email) {
        return User::where('email', $email)->first();
    }

    public function setToken($email, $token)
    {
        try {
            User::where('email', $email)->update(['token'=>$token]);
            return true;
        }
        catch(Exception $exeption) {
            return false;
        }
    }

    public function checkUser($email, $token) {
        return User::where([
            'email'=>$email,
            'token'=>$token
        ])->first();
    }

    public function resetPassword($email, $password) {
        try {
            User::where('email', $email)->update(['password'=>bcrypt($password), 'token'=>null,]);
            return true;
        }
        catch(Exception $exeption) {
            return false;
        }
    }

    public function getAllUser(array $request) {
        $query = DB::table('customers');
        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if ($key == 'status') {
                    $query->where($key, '=', $value);
                } else {
                    $query->where($key, 'like', '%' . $value . '%');
                }
            }
        }
        return $query->paginate($this->perPage);
    }

    public function changeStatus($id)
    {
        try {
            $user = User::find($id);
            if ($user->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();
            return true;
        }
        catch(Exception $exeption) {
            return false;
        }
    }

    // public function orderProcessing() {
    //     return User::join('orders','orders.user_id','=','customers.id')
    //         ->select('customers.phone','customers.full_name','orders.*')
    //         ->orderBy('orders.order_date', 'desc')
    //         ->limit(3)
    //         ->get();
    // }

    // public function dataOrder($orderId) {
    //     return User::join('orders','orders.user_id','=','customers.id')
    //         ->join('orderdetails','orderdetails.order_id','=','orders.order_id')
    //         ->join('products','products.id','=','orderdetails.id_product')
    //         ->select('customers.address','customers.phone','customers.full_name','customers.email','orders.*','orderdetails.*','products.image','products.product_name')
    //         ->where('orderdetails.order_id','=',$orderId)
    //         ->get();
            
    // }

    // public function getOrderByCustomer()
    // {
    //     return User::join('orders','orders.user_id','=','customers.id')
    //         ->select('customers.address','customers.phone','customers.full_name','orders.*')
    //         ->orderBy('orders.order_date', 'desc')
    //         ->where('orders.status',1)
    //         ->get();
    // }
}
