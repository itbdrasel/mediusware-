<?php

namespace Modules\Core\Http\Controllers\Auth;


use Illuminate\Routing\Controller;

use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Http\Request;

use Validator;

class ChangePasswordController extends Controller
{
    private $data;

    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;
    }

     public function changePassword(){
         $this->data = [
             'title'    =>'Change Password',
             'users'    => $this->auth->getAllUser(),
         ];
         return view('system.auth.change_password', $this->data);
     }

    public function changePasswordStore(Request $request){
        $validator = Validator::make($request->all(),[
            'user'      => 'required',
            'password'  => 'required|confirmed|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Provide Valid Information' );
        }
        $id = $request['user'];
        $user = $this->auth->findById($id);
        $this->auth->update($user, ['password' => $request['password']]);

//        return redirect('system/core/profile/'.$id)->with('success', 'Successfully Updated');
        return redirect()->back()->with('success', 'your password has been changed successfully.');
    }


}
