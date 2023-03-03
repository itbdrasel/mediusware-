<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Modules\Scms\Services\Backend\Controller;


use Illuminate\Http\Request;
use Modules\Scms\Models\SettingSC;
use Modules\Scms\Models\Version;
use Validator;

class SettingsController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->model        = SettingSC::class;
        $this->bUrl         = $this->moduleName.'/settings';
        $this->title        = 'Setting';
    }


    public function layout($pageName){
        echo $this->getLayout('settings',$pageName);
    }


    public function index(){

        $this->data = [
                'title'     => 'System Settings',
                'page_icon' => '<i class="fa fa-book"></i>',
                'pageUrl'   => $this->bUrl,
                'allData'   => $this->bUrl,
                'versions'  => Version::all()
            ];

        $this->layout('index');
    }

    public function store(Request $request)
    {

        $rules = [
            'running_year'      => 'required|regex:/^[0-9]{4,}-[0-9]{4,}$/',
            'r_year_format'     => 'required|regex:/^[1-2]{1,}$/',
            'vtype'             => 'required',
        ];

        $attribute =[
            'r_year_format'     => 'Year format',
            'vtype'             => 'Year format'
        ];

        $customMessages =[];

        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data =[
            'running_year'      => $request['running_year'],
            'r_year_format'     => $request['r_year_format'],
            'vtype'             => $request['vtype'],
        ];
        foreach ($data as $key=>$value){
            if ($value != config('sc_setting')[$key]) {
                $this->model::where('name', $key)->update(['value'=>$value]);
            }
        }
        return redirect()->back()->with('success', 'Successfully Updated');
    }




}
