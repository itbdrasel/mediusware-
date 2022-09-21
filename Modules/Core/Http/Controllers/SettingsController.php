<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Routing\Controller;

use Modules\Core\Entities\Settings;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Http\Request;
use Validator;

class SettingsController extends Controller
{

    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth         = $auth;
        $this->model        = Settings::class;
        $this->moduleName   = 'core';
        $this->bUrl         = $this->moduleName.'/settings';
        $this->title        = 'Setting';
    }



    public function layout($pageName){

        $this->data['bUrl']     =  $this->bUrl;
        echo view($this->moduleName.'::pages.settings.'.$pageName.'', $this->data);

    }

    public function index(){

        $this->data = [
                'title'     => 'System Settings',
                'page_icon' => '<i class="fa fa-book"></i>',
                'pageUrl'   => $this->bUrl,
                'allData'   => $this->bUrl,
                'allTex'    => [],
            ];
//        $this->data['allTex']   = Tax::orderBy('tax_id', 'ASC')->get();

        $this->layout('index');
    }

    public function store(Request $request)
    {

        $rules = [
            'app_name'          => 'required',
            'app_title'         => 'required',
            'app_url'           => 'required',
            'email'             => 'required',
            'app_address'       => 'required',
            'contact'           => 'required',
            'currency_symbol'   => 'required',
            'currency_order'    => 'required',
            'date_format'       => 'required',
            'usd_rate'          => 'required',
        ];

        $attribute =[];

        $customMessages =[];

        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $network_name = $request['network_name'];
        $social = [];
        if (!empty($network_name)) {
            foreach ($network_name as $key=>$value){
                if (!empty($value)) {
                    $social[]=  [
                        'network_name'=>$value,
                        'network_link'=>$request['network_link'][$key],
                    ];
                }
            }
        }

        $payments = [
            'paypal'        => $request['paypal'],
            'stripe'        => $request['stripe'],
            'sslcommerz'    => $request['sslcommerz'],
        ];


        $data = [
            'appName'           => $request['app_name'],
            'appTitle'          => $request['app_title'],
            'url'               => $request['app_url'],
            'email'             => $request['email'],
            'appAddress'        => $request['app_address'],
            'contact'           => $request['contact'],
            'c_symbol'          => $request['currency_symbol'],
            'c_order'           => $request['currency_order'],
            'date_format'       => $request['date_format'],
            'usd_rate'          => $request['usd_rate'],
            'default_tax'       => $request['default_tax'],
            'include_tax'       => $request['include_tax']??0,
            'only_default_tax'  => $request['only_default_tax']??0,
            'social'            => json_encode($social),
            'analytics'         => $request['analytics'],
            'language'          => $request['language'],
            'payment'            => json_encode($payments),
        ];

        foreach ($data as $key=>$value){
            if ($value != config('settings')[$key]) {

                $this->model::where('s_name', $key)->update(['s_value'=>$value]);
            }
        }

        $tex_id = $request['tax_id'];

        Tax::where('status',1)->update(['status'=>8]);
        foreach ($tex_id as $key=>$value){

            $texData =[
                'tax_name'      => $request['tax_name'][$key],
                'tax_percent'   => $request['tax_percent'][$key],
                'status'        => 1,
            ];
            if (!empty($value)) {
                Tax::where('tax_id', $value)->update($texData);
            }else{
                if (!empty($request['tax_name'][$key])) {
                    Tax::create($texData);
                }
            }
        }
        Tax::where('status',8)->delete();
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function logo(Request $request)
    {

        $this->data = [
            'title'     => 'Setting Logo',
            'page_icon' => '<i class="fa fa-book"></i>',
            'pageUrl'   => $this->bUrl.'/logo/',
        ];
        $objData = $this->model::where('s_name', 'logo')->first();
        $this->data['objData'] = $objData;

        if($request->method() === 'POST' ){

            $rules = [
                'logo' => ['required', 'max:1024', 'dimensions:max_width=1000,max_height=1000', 'mimes:jpeg,bmp,png'],
            ];

            $attributes = [
                'logo' => 'logo',
            ];

            $validator = Validator::make($request->all(), $rules, [],  $attributes);

            if($validator->fails()){
                echo json_encode(['fail' => TRUE, 'messages' => $validator->errors()->first().$request->file('logo') ]);
            }else{


                $logo = $request->file('logo');
                $image_name = 'logo.'.$logo->getClientOriginalExtension();
                $dir_name = "/uploads/core/settings";

                // remove from dir
                if(file_exists(public_path().$objData->s_value) && $dir_name.$image_name !=$objData->s_value){
                    //only remove file.
                    if(is_file(public_path().$objData->s_value) ) unlink(public_path().$objData->s_value);
                }
                //processing image file

                $logo->move(public_path().$dir_name, $image_name);

                $this->model::where('s_name', 'logo')->update( ['s_value' => $dir_name.$image_name] );

                echo json_encode(['fail' => FALSE, 'messages' => "Logo Uploaded"]);
            }

        }else{
            $this->layout('logo');
        }

    }


}
