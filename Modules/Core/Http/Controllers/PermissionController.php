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
                $permissions = $this->data['rolePermissions'] = $this->auth->findRoleById($role);
                $query = $this->model::orderBy('section_name');
                if ($section_id) {
                    $query->where('id', $section_id);
                }
                if ($module_id) {
                    $query->where('module_id', $module_id);
                    $this->data['sections'] = $this->model::orderBy('module_id')->where('module_id', $module_id)->with('module')->get();
                }

                $sectionNames = $this->data['sectionNames'] = $query->get();
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
            return redirect()->back()->with('success', 'Data Recorded Successful.');
        }

    }







    public function permissions(Request $request){

/*	$routeCollection = Route::getRoutes();
	echo "<table border='1' style='border:1px solid #ccc;'>";

	foreach ($routeCollection as $route) {

		//if($route->getPrefix() === 'hotels/' || $route->getPrefix() === '/hotels'){


		echo "<tr><td>".$route->uri."</td>
			<td>".$route->getName()."</td>
			<td>".$route->getPrefix()."</td>
			<td>".$route->getActionMethod()."</td>
			<!--<td>".$route->getActionName()."</td>--></tr>";

		//}

	}

	echo "</table";

	die();	*/


	//$roles =

        $this->data = [
            'title'     => 'User Role Manager',
            'pageUrl'   => $this->bUrl,
			'page_icon' => '<i class="fa fa-book"></i>',
        ];

        $this->data['user']  = $this->auth->getUser();
		$this->data['sectionNames'] = collect();
		$this->data['rolePermissions'] = collect();

		if($request->method() === 'POST' ){

			$rules = [
				'role'	=> ['required'],
			];
			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()){
				return redirect()->back()->withErrors($validator)->withInput();
			}else{

				$role = $this->data['roleId'] = $request->post('role');

				$section = $this->data['sectionId'] = $request->post('section');
				$module = $this->data['module'] = $request->post('module');

				$permissions = $this->data['rolePermissions'] = $this->auth->findRoleById($role);

				//dd($permissions->permissions);
                $query = DB::table('tbl_module_sections');
                if ($section) {
                    $query->where('section_id',$section);
                }
                if ($module) {
                    $query->where('section_module_name',$module);
                }
				$sectionNames = $this->data['sectionNames'] = $query->get();

				//dd($sectionNames);

			}


		}



        return view('system.auth.permissions', $this->data);
    }


    public function assign(Request $request){

        $role = $this->auth->findRoleByName($request->role);
        $action = $request->action;
        $value = ($request->value == 1) ? true : false;
        $section = $request->section;
        $permission_name = $request->name;
		if($role){
			$role->removePermission($action,$value)->save();
        	$role->addPermission($action,$value)->save();
            if ($value == true){
                $log_title = 'Route (Section : '.$section  .', Permission : '.$permission_name.') was add by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_permission_add');
            }else{
                $log_title = 'Route (Section : '.$section  .', Permission : '.$permission_name.') was remove by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_permission_remove');
            }

		}else{
			return false;
		}

    }


    public function userPermission(Request $request){
        $user = $this->auth->findUserById($request['id']);
        $action = $request->action;
        $section = $request->section;
        $permission_name = $request->name;
        $value = ($request->value == 1) ? true : false;
        if($user){
            $user->removePermission($action,$value)->save();
            $user->addPermission($action,$value)->save();
            if ($value == true){
                $log_title = 'Route (Section : '.$section  .', Permission : '.$permission_name.') was add by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_permission_add');
            }else{
                $log_title = 'Route (Section : '.$section  .', Permission : '.$permission_name.') was remove by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_permission_remove');
            }
        }else{
            return false;
        }

    }

    public function userModulePermission(Request $request){
	    $user_id = $request['id'];

        $user =User::find($user_id);
        $user_s = $this->auth->findUserById($request['id']);
        $module_name =$request->module_name;
        $a_value = ($request->value == 1) ? true : false;
        if($user && $user_s){
            $modules =   DB::table('tbl_module_sections')->orderBy('section_module_name')->where('section_module_name', $module_name)->orderBy('section_name')->orderBy('section_id')->get();
            if (!empty($modules)) {
                foreach ($modules as $module) {
                    $sectionPermission = json_decode($module->section_roles_permission);
                    $role_id = $user->role->role_id ?? '';
                    if (in_array($role_id, $sectionPermission)) {
                        $route_names = json_decode($module->section_action_route);
                        foreach ($route_names as $key => $value) {
                            if (in_array($role_id, $value)) {
                                $user_s->removePermission($key, $a_value)->save();
                                $user_s->addPermission($key, $a_value)->save();
                            }
                        }
                    }
                }
            }
            if (!empty($user->m_permission)) {
                $db_modules = json_decode($user->m_permission);
                $status =true;
                if (!empty($db_modules)) {
                    foreach ($db_modules as $key=>$value){
                        if ($module_name == $key) {
                            $value= $a_value;
                            $status =false;
                        }
                        $m_permission[$key] = $value;
                    }
                }
                if ($status) {
                    $m_permission[$module_name] = $a_value;
                }
            }else{
                $m_permission[$module_name] = $a_value;
            }
            $data = [
                'm_permission' =>json_encode($m_permission),
            ];
            User::where('id', $user_id)->update($data);
        }else{
            return false;
        }
    }


    public function routeRegister(Request $request, PermissionService $permissionService){

        $this->data = [
            'title'     => 'Register New Route',
            'pageUrl'   => $this->bUrl,
			'page_icon' => '<i class="fa fa-book"></i>',
        ];

        $this->data['user']  = $this->auth->getUser();

		if($request->method() === 'POST' ){

			$validator = $permissionService->routeValidation($request);
			if($validator->fails()){
				return redirect()->back()->withErrors($validator)->withInput();
			}else{
				$permissionService->routeRegister($request);
				return redirect()->back()->with('success', 'Data Recorded Successful.');
			}
		}
        return view('system.auth.route_register', $this->data);
    }

    public function routeRegisterEdit(Request $request){

        $this->data = [
            'title'     => 'Register Edit Route',
            'pageUrl'   => $this->bUrl.'_edit',
            'page_icon' => '<i class="fa fa-book"></i>',
        ];

        $this->data['user']         = $this->auth->getUser();
        $this->data['sections']     = DB::table('tbl_module_sections')->get();
        $this->data['route'] ='';
        $this->data['sectionId'] ='';
        if($request->method() == 'GET' ){
            $section_id = $request['section'];
            $this->data['sectionId'] = $section_id;
            $this->data['route']        = DB::table('tbl_module_sections')->where('section_id',$section_id)->first();
        }


        if($request->method() === 'POST' ){
            $id = $request['section_id'];
            $sectionName = $request->post('section_name');
            $routes_name = $request['route_name'];

            $routeNames =[];
            $sectionRoute=[];

            foreach ($routes_name as $key=>$value){

                $roles = (array_key_exists ($key , $request['roles']))?$request['roles'][$key]:[''];

                if (Route::has($value) ) {
                    $routeNames[$value] = $roles;
                    $sectionRoute[]=$roles;

                }

            }
            $roles_permission =trim($this->arrayValue($sectionRoute),',"');

            $routeData = [
                'section_name' => $sectionName,
                'section_action_route' => json_encode($routeNames),
                'section_roles_permission' => '["'.$roles_permission.'"]',
            ];
            $getRoutes = DB::table('tbl_module_sections')->select('section_id')->where([ 'section_name' => $sectionName] )->first();
            if (!empty($getRoutes) &&  $getRoutes->section_id !=$id) {
                ModuleSection::where([ 'section_id' => $id] )->delete();
                ModuleSection::where('section_name',$sectionName)->update($routeData);
                $log_title = 'Route (Section : '.$sectionName  .') was update by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_section_update');
                return redirect('system/core/permissions')->with('success', 'Data Successful Update.');
            }else{
                ModuleSection::where([ 'section_id' => $id] )->update($routeData);
                $log_title = 'Route (Section : '.$sectionName  .') was update by '. $this->auth->getUser()->full_name;
                Logs::create($log_title,'route_section_update');
            }

            return redirect()->back()->with('success', 'Data Successful Update.');
        }
        return view('system.auth.route_register_edit', $this->data);
    }


    function array_flatten($array) {
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    function arrayValue($array){
        $data = $this->array_flatten($array);
        $data = array_unique(array_values($data));
        $result = '';
        foreach ($data as $key => $value) {
            $result .= '"'.(int)$value.'",';
        }
        return $result;
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
