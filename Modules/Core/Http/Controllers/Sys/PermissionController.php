<?php

namespace App\Http\Controllers\Sys;
use App\Http\Controllers\Controller;

use App\Helpers\Logs;
use App\Models\ModuleSection;
use App\Repositories\AuthInterface as Auth;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

use App\Services\PermissionService;


class PermissionController extends Controller
{

	private $moduleName;
	private $data;
	private $bUrl;

    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;

		 $this->tableId = 'roles';
		 $this->moduleName = 'system/core';
		 $this->bUrl = $this->moduleName.'/permissions';
	}

	public function roles(Request $request){
        $this->data = [
            'title'         => 'Role Manage',
            'pageUrl'       => $this->moduleName.'/roles',
            'page_icon'     => '<i class="fa fa-book"></i>',
            'roles'         => DB::table('roles')->get(),
        ];

        return view('system.auth.roles', $this->data);
    }
    public function roleCreate(){
        $this->data = [
            'title'         => 'Add New Role',
            'pageUrl'       => $this->moduleName.'/roles',
            'page_icon'     => '<i class="fa fa-book"></i>',
        ];

        return view('system.auth.role_create', $this->data);
    }
    public function roleStore(Request $request){
        $rules = [
            'role_name'     =>'required|max:255',
            'role_slug'     =>'required|max:255|unique:roles,slug',
            'redirect'      =>'required|max:255|',
        ];
        $attribute =[];
        $customMessages =[];
        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->auth->createRole([
            'name'      => $request['role_name'],
            'slug'      => $request['role_slug'],
            'redirect'  => $request['redirect'],
            'session_data'  => json_encode([
                'session_key'   => $request['session_key'],
                'session_value' => $request['session_value'],
            ]),
        ]);
        $log_title = 'Role ('.$request['role_slug'].') was Create by '. $this->auth->getUser()->full_name;
        Logs::create($log_title,'role_create');
        return redirect($this->moduleName.'/roles')->with('success', 'Record Successfully Created.');
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
