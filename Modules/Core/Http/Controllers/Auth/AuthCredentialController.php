<?php

namespace Modules\Core\Http\Controllers\Auth;

use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Validator;


class AuthCredentialController extends Controller
{
    private $data;
    private $bUrl;
    private $title;

    private $auth;

    public function __construct(Auth $auth){
        $this->auth         = $auth;

        $this->moduleName   = 'core';
        $this->bUrl         = $this->moduleName;
        $this->title        = 'Login';
    }



    public function layout($pageName){
        $this->data['bUrl']     = $this->bUrl;
        echo view($this->moduleName.'::pages.auth.'.$pageName.'', $this->data);

    }


    /* * *
     * login()
     *
     */

    public function login(){

        if($this->auth->check()){

            return $this->auth->roleRedirect();
        }

        $this->data = [
            'title'         => 'Login - '.config('appTitle'),
            'pageUrl'       => $this->bUrl.'/login'
        ];

        $this->layout('login');
    }

    /* * *
    * login_user()
    *
    */

    public function store(Request $request){

        $errorMsg = [
            'email.required'    => 'Enter an Email Address.',
            'email.email'       => 'Enter an Valid Email Address!',
            'password.required' => 'Enter a Password.',
        ];

        $validator      = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required'
        ], $errorMsg);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $getCredentials = $request->only('email', 'password');

        $authenticate = $this->auth->authenticate($getCredentials );

        if( !$authenticate->hasFailed() ){
            return $this->auth->roleRedirect();
        }else{
            return redirect()->back()->withErrors('Sorry your email or password is incorrect. Please try again.')->withInput();
        }

    }


    /* * *
 * logout()
 *
 */
    public function logout(){

        $this->auth->logout();

        return redirect($this->bUrl.'/login');
    }


}
