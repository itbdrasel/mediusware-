<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;

use App\Models\HotelList;
use App\Repositories\AuthInterface as Auth;
use Session;

class SystemController extends Controller
{
    private $data;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;
    }

    public function index(){

        if($this->auth->check()){
            return redirect('/home');
        }
        echo 'Access Denied !';
    }
    public function home(){
        $this->data['title'] = config('settings')['appTitle'].' ERP System';
        $this->data['user'] = $this->auth->getUser();

        // clear module sessions.
        session()->forget(['_module', '_hotel_id','hr_hotel_id']);

        return view('home',$this->data);
    }


    public function hotel_module(){
        if(! moduleCheck($this->auth->getUser()->m_permission, 'hotels')){
            return 'You are not permitted to access here!';
        }

        $this->data['title'] = 'BPC';
        $this->data['hotels'] = HotelList::where(['h_type'=>1, 'h_isActive'=>1])->get();

        session()->forget(['_hotel_id']); // remove hotel specific session

        //hms - Hotel Management System.
        session(['_module' => 'hms' ]);

        return view('hotel_home',$this->data);
    }

    public function hall_module(){
        if(! moduleCheck($this->auth->getUser()->m_permission, 'halls')){
            return 'You are not permitted to access here!';
        }
        $this->data['title'] = 'BPC';
        $this->data['hotels'] = HotelList::where('is_hall',1)->where(['h_type'=>1, 'h_isActive'=>1])->get();

        session()->forget(['_hotel_id']); // remove hotel specific session
        //hms - Hotel Management System.
        session(['_module' => 'hms' ]);

        return view('halls::hall_home',$this->data);
    }


    public function hrms_module(){
        session(['_module' => 'hrms' ]);
        return redirect('hrms/working-station');
    }



    public function payroll_module(){
        session(['_module' => 'payroll' ]);
        return redirect('hrms/working-station');
    }

    public function system_module(){
        if(! moduleCheck($this->auth->getUser()->m_permission, 'system')){
            return 'You are not permitted to access here!';
        }
        session(['_module' => 'system' ]);
        $this->data['title'] = 'BPC';
        return view('system_home',$this->data);
    }

    public function hotel_logoff(){
        session(['_hotel_id' => $this->auth->getUser()->hotel_id]);
        return redirect()->route('hotel.home');

    }

}
