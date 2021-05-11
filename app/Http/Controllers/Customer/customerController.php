<?php

namespace App\Http\Controllers\Customer;
use App\Mail\TestMail;
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
        if(Auth::attempt($data)){

            return redirect('/');
        }
        else{
            return redirect('signin')->with('loginFalse','Tài khoản mật khẩu không chính xác!');
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

    public function signup(Request $request){
            $email = $request->email;
            $username = $request->userName;
            $password = $request->password1;

        $this->user->postSignUp($email, $username, $password);
        return redirect()->back()->with('thanhcong','Đăng ký tài khoản thành công!');
    }


    public function form_forget_password(){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.forget_password', compact('category','category1'));
    }

    public function editInfor(){
        $userID = Auth::user()->id;
        $address = $this->deliveryAddress->getAddressByUserId($userID);
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        return view('customer.update_infor', compact('category','category1', 'address'));
    }

    public function updateInfor(Request $request){
        if($request->hasFile('avatar')){
            $fileImg = $request->avatar;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);

            $username = $request->username;
            $fullname = $request->full_name;
            $avatar = $fileName;
            $birthdate = $request->birth_date;
            $statusUpdate = $this->user->postUpdateInfor($username, $fullname, $avatar, $birthdate);
            return redirect()->back()->with('update-infor','Cập nhật thông tin thành công!');
        }
    }

    public function changePassword(Request $request)
    {
        $password = Auth::user()->password;
        if(Hash::check($request->old_password, $password)){
            $this->user->changePassword($request->new_password);
            return redirect()->back()->with('thaymatkhau2','Thay đổi mật khẩu thành công!');
        }
        else{
            return redirect()->back()->with('thaymatkhau','Mật khẩu cũng không đúng!');
        }
    }

    public function addFeedback(SendEmailResetPass $request){
        $email = $request->email;
        $checkUser =  $this->user->checkEmail($email);
        if(!$checkUser){
            return redirect()->back()->with('danger','Email không tồn tại');
        }
        $token = bcrypt(md5(time().$email));
        $checkUser->token = $token;
        $checkUser->timeToken = Carbon::now('Asia/Ho_Chi_Minh');
        $checkUser->save();

        $url = route('get.link.reset.password',['token'=>$checkUser->token, 'email'=>$email]);
        $data = [
            'route'=>$url
        ];

        Mail::send('customer.send_gmail',$data, function ($message) use($email){
            $message->to($email,'Reset Password')->subject('Thay đổi mật khẩu');
        });
        return redirect()->back()->with('sendEmail','Hệ thống đã gửi Link thay đổi mật khẩu về Email của bạn. Vui lòng kiểm tra!');
    }

    public function formReset(Request $request){
        $category = $this->category->getCategoryParent(0);
        $category1 = $this->category->getCategoryChill();
        $email = $request->email;
        $token = $request->token;
        $checkUser = $this->user->checkUser($email, $token);
        if(!$checkUser){
            return redirect('/')->with('loiduongdan','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else {
            return view('customer.reset_password', compact('category', 'category1','email','token'));
        }
    }

    public function saveResetPassword(ResetPassword $request){
        $email = $request->email;
        $token = $request->token;
        $password = $request->newPassword1;
        $checkUser = $this->user->checkUser($email, $token);
        if(!$checkUser){
            return redirect('/')->with('loiduongdan','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else{
            $checkUser->password = bcrypt($password);
            $checkUser->save();
            return redirect()->back()->with('resetPassword','Mật khẩu đã được thay đổi!');
        }
    }
}
