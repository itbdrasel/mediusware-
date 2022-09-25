<?php
namespace Modules\Core\Http\Controllers;

use Modules\Core\Entities\Module;
use Modules\Core\Entities\Roles;
use Modules\Core\Repositories\AuthInterface as Auth;

use Modules\Core\Entities\ModuleSection;
use Modules\Core\Entities\User;

use Modules\Core\Services\PermissionService;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class PermissionController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $auth;
    private $moduleName;

    public function __construct(Auth $auth){
        $this->auth         = $auth;
        $this->model        = ModuleSection::class;
        $this->moduleName   = 'core';
        $this->bUrl         = $this->moduleName.'/permissions';
        $this->title        = 'User Permission';
    }


    public function layout($pageName){

        $this->data['bUrl']     =  $this->bUrl;
        echo view($this->moduleName.'::pages.permissions.'.$pageName.'', $this->data);

    }

    public function index(Request $request){
        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'roles'         => Roles::get(),
            'modules'       =>  Module::where('status',1)->get(),
            'sections'      =>  $this->model::orderBy('module_id')->with('module')->get(),
            'sectionNames'  =>  [],
        ];



        if($request->method() === 'POST' ){
            $rules = [
                'role_id'	=> ['required'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $role = $this->data['role_id'] = $request['role_id'];
                $section_id = $this->data['section_id'] = $request['section_id'];
                $module_id = $this->data['module_id'] = $request['module_id'];
                $this->data['rolePermissions'] = $this->auth->findRoleById($role);
                $query = $this->model::orderBy('section_name');
                if ($section_id) {
                    $query->where('id', $section_id);
                }
                if ($module_id) {
                    $query->where('module_id', $module_id);
                    $this->data['sections'] = $this->model::orderBy('module_id')->where('module_id', $module_id)->with('module')->get();
                }

                $this->data['sectionNames'] = $query->get();
            }
        }


        $this->data['role_id']       = $request['role_id'];
        $this->data['section_id']    = $request['section_id'];
        $this->data['module_id']       = $request['module_id'];

        $this->layout('index');
    }


    public function create(){
        $this->data = [
            'title'         => $this->title.' Create',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-plus"></i>',
            'modules'       =>  Module::where('status',1)->get(),
            'roles'         =>  Roles::get(),
        ];

        $this->layout('create');
    }



    public function store(Request $request, PermissionService $permissionService){
        $validator = $permissionService->routeValidation($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $permissionService->routeRegister($request);
            return redirect()->back()->with('success', 'Data Recorded Successful.')->withInput();
        }

    }

    public function edit(){
        $this->data = [
            'title'         => $this->title.' Edit',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-edit"></i>',
            'modules'       =>  Module::where('status',1)->get(),
            'roles'         =>  Roles::get(),
        ];

        $this->layout('edit');
    }



    // Ajax Json Query

    public function addRemove(Request $request){
        $role = $this->auth->findRoleByName($request->role);
        $action = $request->action;
        $value = ($request->value == 1) ? true : false;
		if($role){
			$role->removePermission($action,$value)->save();
        	$role->addPermission($action,$value)->save();
		}else{
			return false;
		}
    }




    // Ajax Json Query
    function routeRemove(Request $request){
	    $id     = $request['id'];
	    $route  = $request['route'];
        $actionName = substr($route, strrpos($route, '.'));
        $actionName = trim($actionName,'.');


        $route_date = DB::table('tbl_module_sections')->where('section_id',$id)->first();
        $actions = json_decode($route_date->section_action_route);

        if (!empty($actions->$route)) {

            unset($actions->$route);
            $log_title = 'Route (Section : '.$route_date->section_name  .', Permission : '.$actionName.') was delete by '. $this->auth->getUser()->full_name;
            Logs::create($log_title,'route_permission_delete');
        }

        DB::table('tbl_module_sections')->where('section_id',$id)->update(['section_action_route'=>json_encode($actions)]);
    }

    function routeCheck(Request $request){
        $route_name     = $request['route_name'];
        $error = true;
        if (!Route::has($route_name)) {
            $error = false;
            $message = 'The '.$route_name.' is not exist.';
        }
        return json_encode(['error'=>$error, 'message'=>$message]);

    }

}
