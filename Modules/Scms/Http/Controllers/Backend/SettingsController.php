<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Routing\Controller;

use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Http\Request;
use Modules\Scms\Entities\SettingSC;
use Modules\Scms\Entities\Version;
use Validator;

class SettingsController extends Controller
{

    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $auth;
    private $moduleName;

    public function __construct(Auth $auth){
        $this->auth         = $auth;
        $this->model        = SettingSC::class;
        $this->moduleName   = getModuleName(get_called_class());
        $this->bUrl         = $this->moduleName.'/settings';
        $this->title        = 'Setting';
    }



    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::backend.settings.'.$pageName.'', $this->data);

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
