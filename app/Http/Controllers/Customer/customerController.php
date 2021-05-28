<?php

namespace App\Http\Controllers\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateInfor;
use App\Http\Requests\SendEmailResetPass;
use App\Http\Requests\ResetPassword;
use App\Http\Requests\Signin;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\DeliveryAddress;
use App\Models\User;
use App\Events\ResetPassword as EventChangePassword;
use App\Http\Requests\SignupUserRequest;
use App\Http\Requests\UpdateInforUserRequest;

class customerController extends Controller
{
    //
    protected $category;
    protected $user;
    protected $deliveryAddress;
    public function __construct(Category $category, User $user, DeliveryAddress $deliveryAddress)
    {
        $this->category = $category;
        $this->user = $user;
        $this->deliveryAddress = $deliveryAddress;
    }

    public function form_signin(){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.login', compact('category','category1'));
    }
    public function signin(Signin $request){
        $data = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth::attempt($data)) {
            if(Auth::user()->status == 1) {
                return redirect('/');
            }
            elseif(Auth::user()->status == 0) {
                Auth::logout();
                return redirect('signin')->with('error','Tài khoản đã bị khóa');
            }
        }
        else{
            return redirect('signin')->with('error','Tài khoản mật khẩu không chính xác!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('cart');
        return redirect('/');
    }

    public function form_signup(){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.register', compact('category','category1'));
    }

    public function signup(SignupUserRequest $request){
            $email = $request->email;
            $username = $request->userName;
            $password = $request->password1;

        $this->user->postSignUp($email, $username, $password);
        return redirect()->back()->with('success','Đăng ký tài khoản thành công!');
    }


    public function formForgetPassword(){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.forgot_password', compact('category','category1'));
    }

    public function editInfor(){
        $userID = Auth::user()->id;
        $address = $this->deliveryAddress->getAddressByUserId($userID);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.update_infor', compact('category','category1', 'address'));
    }

    public function updateInfor(UpdateInforUserRequest $request){
        $fileName = null;
        if($request->hasFile('avatar')){
            $fileImg = $request->avatar;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);
        }
        $username = $request->username;
        $fullname = $request->full_name;
        $avatar = $fileName;
        $birthdate = $request->birth_date;
        $statusUpdate = $this->user->postUpdateInfor($username, $fullname, $avatar, $birthdate);
            
        return redirect()->back()->with('success','Cập nhật thông tin thành công!');
    }

    public function changePassword(ChangePassword $request)
    {
        $password = Auth::user()->password;
        if(Hash::check($request->old_password, $password)){
            $this->user->changePassword($request->new_password);
            return redirect()->back()->with('success','Thay đổi mật khẩu thành công!');
        }
        else{
            return redirect()->back()->with('error','Mật khẩu cũng không đúng!');
        }
    }

    public function seedForgotPassword(SendEmailResetPass $request){
        $email = $request->email;
        $checkUser =  $this->user->checkEmail($email);
        if(!$checkUser){
            return redirect()->back()->with('success','Email không tồn tại');
        }
        $token = bcrypt(md5(time().$email));

        $setToken = $this->user->setToken($email, $token);
        if (!$setToken) {
            return redirect()->back()->with('error','That bai');
        }
        $url = route('get.link.reset.password',['token'=>$token, 'email'=>$email]);
        $data = [
            'route'=>$url
        ];

        event(new EventChangePassword($data, $email));
        return redirect()->back()->with('success','Hệ thống đã gửi Link thay đổi mật khẩu về Email của bạn. Vui lòng kiểm tra!');
    }

    public function formReset(Request $request){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $email = $request->email;
        $token = $request->token;
        $checkUser = $this->user->checkUser($email, $token);
        if(!$checkUser){
            return redirect('/')->with('error','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else {
            return view('customer.reset_password', compact('category', 'category1','email','token'));
        }
    }

    public function saveResetPassword(ResetPassword $request){
        $email = $request->email;
        $token = $request->token;
        $password = $request->password;
        $checkUser = $this->user->checkUser($email, $token);
        if(!$checkUser){
            return redirect('/')->with('error','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else{
            $this->user->resetPassword($email, $password);
            return redirect()->back()->with('success','Mật khẩu đã được thay đổi!');
        }
    }
}
