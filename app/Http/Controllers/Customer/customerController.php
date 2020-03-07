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
class customerController extends Controller
{
    //
    public function getCategoryParent(){

        return \App\Category::where('subCategoryID', '0')->get();
    }

    public function getCategoryChill(){
        return \App\Category::where('subCategoryID','!=', '0')->get();
    }



    public function form_signin(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('customer.signin', compact('category','category1'));
    }
    public function signin(Signin $request){
        // dd($request->password);
        $data = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth::attempt($data)){

            return redirect('trangchu');
        }
        else{
            return redirect('signin');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('cart');
        return redirect('trangchu');
    }

    public function form_signup(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('customer.signup', compact('category','category1'));
    }

    public function signup(Request $request){

            $email = $request->email;
            $username = $request->userName;
            $password = $request->password1;

        $user = new \App\User();
        $user->email = $email;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->save();
        return redirect()->back()->with('thanhcong','Đăng ký tài khoản thành công!');
    }


    public function form_forget_password(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('customer.forget_password', compact('category','category1'));
    }

    public function formUpdateInfor(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('customer.update_infor', compact('category','category1'));
    }

    public function updateInfor(UpdateInfor $request){
//        dd($request);
        $id = Auth::user()->id;
        $username = $request->username;
        $fullname = $request->fullName;
        $phone = $request->phone;
        $address = $request->address;
        $birthdate = $request->birthDate;

        $user = \App\User::find($id);
        $user->username = $username;
        $user->fullName = $fullname;
        $user->phone = $phone;
        $user->address = $address;
        $user->birthDate = $birthdate;
        $user->save();

        return redirect()->back()->with('update-infor','Cập nhật thông tin thành công!');
    }

    public function form_changePass(){
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        return view('customer.change_password', compact('category','category1'));
    }

    public function changePassword(ChangePassword $request){

        $id = Auth::user()->id;
        $password = Auth::user()->password;
        if(Hash::check($request->password, $password)){

            $user = \App\User::find($id);
            $user->password = bcrypt($request->newPassword1);
            $user->save();
            return redirect()->back()->with('thaymatkhau2','Thay đổi mật khẩu thành công!');
        }
        else{
            return redirect()->back()->with('thaymatkhau','Mật khẩu cũng không đúng!');
        }
    }

    public function addFeedback(SendEmailResetPass $request){
        $email = $request->email;
        $checkUser =  \App\User::where('email', $email)->first();
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
        $category = $this->getCategoryParent();
        $category1 = $this->getCategoryChill();
        $email = $request->email;
        $token = $request->token;
        $chechUser = \App\User::where([
            'email'=>$email,
            'token'=>$token
        ])->first();
        if(!$chechUser){
            return redirect('/')->with('loiduongdan','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else {
            return view('customer.reset_password', compact('category', 'category1','email','token'));
        }
    }

    public function saveResetPassword(ResetPassword $request){
//        dd($request->all());
        $email = $request->email;
        $token = $request->token;
        $password = $request->newPassword1;
        $chechUser = \App\User::where([
            'email'=>$email,
            'token'=>$token
        ])->first();
        if(!$chechUser){
            return redirect('/')->with('loiduongdan','Đường dẫn lấy lại mật khẩu không đúng. Vui lòng thử lại!');
        }
        else{
            $chechUser->password = bcrypt($password);
            $chechUser->save();
            return redirect()->back()->with('resetPassword','Mật khẩu đã được thay đổi!');
        }
    }
}
