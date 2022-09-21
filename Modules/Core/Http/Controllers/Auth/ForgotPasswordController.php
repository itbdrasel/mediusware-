<?php

namespace Modules\Core\Http\Controllers\Auth;


use Illuminate\Routing\Controller;

use App\Helpers\SuccessError;
use App\User;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Repositories\AuthInterface as Auth;

class ForgotPasswordController extends Controller
{
    private $data;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;
    }

     public function forgotPassword(){
         $this->data['title'] = 'Forgot Password';
         return view('system.auth.forgot_password', $this->data);
     }

    public function forgotPasswordStore(Request $request){
         $email = $request['email'];
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return redirect()->back()->withErrors('This e-mail is not associated with any user account.')->withInput();
        }
        $user = $this->auth->findById($user->id);
        $reminder= $this->auth->reminder($user);




        $name = $user->full_name;
        $code = $reminder->code;
        $message =[
            'email'=>$email,
            'name'=>$name,
            'code'=>$code,
            'reset_url'=>'system/core/reset-password/'.$code,
        ];

        emailSend($email, $name.' reset your password',$message,'forgot_password');
        $data = [
            'email'         => $email,
            'token'         => $code,
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        DB::table('password_resets')->updateOrInsert( ['email' => $email, 'status' =>1], $data );
        return redirect()->back()->with('success', 'Password Reset Instruction was send to your email.');
    }




    public function resetPassword($code){
        $user= DB::table('password_resets')->where('token', $code)->first();

        if (empty($user)) {
            return abort(404);
        }elseif (getHours($user->created_at) >24) {
            return abort(404);
        }
        $this->data['title'] = 'Forgot Password';
        $this->data['user'] = $user;
        return view('system.auth.reset_password', $this->data);
    }

    public function resetPasswordStore(Request $request, $code){

        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required|confirmed',
            'code'      => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Provide Valid Information' );
        }

        $userCheck= DB::table('password_resets')->where('token', $code)->first();
        if (empty($userCheck)) {
            return  SuccessError::errorLogin('Bad Request.','Go to Forgot Password','system/core/forgot-password');
        }
        $email = $request['email'];
        $user = User::where('email', $email)->first();
        $user = $this->auth->findById($user->id);
        try {
            $this->auth->update($user, ['password' => $request['password']]);
             DB::table('password_resets')->where('token', $code)->delete();
            return  SuccessError::successLogin('Your password has been successfully changed. Use your new password to login.','Go to Login','system/core/login');


        } catch (NotUniquePasswordException $e) {
            return redirect()->back()->with('error', 'Bad Request.')->withErrors('Bad Request.')->withInput();
        }

    }

}
