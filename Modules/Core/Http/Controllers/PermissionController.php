<?php
namespace Modules\Core\Http\Controllers;

use Modules\Core\Entities\Module;
use Modules\Core\Entities\Roles;
use Modules\Core\Entities\User;
use Modules\Core\Repositories\AuthInterface as Auth;

use Modules\Core\Entities\ModuleSection;

use Modules\Core\Services\PermissionService;

use Illuminate\Routing\Controller;
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
        $this->moduleName   = getModuleName(get_called_class());
        $this->bUrl         = $this->moduleName.'/permissions';
        $this->title        = 'User Permission';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::pages.permissions.'.$pageName.'', $this->data);

    }

    public function index(Request $request){
        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'roles'         => Roles::get(),
            'modules'       =>  Module::where('status',1)->get(),
            'sectionNames'  =>  [],
        ];

        $role_id        =  $request['role_id'];
        $section_id     =  $request['section_id'];
        $module_id      =  $request['module_id'];
        $sectionsQuery  = $this->model::orderBy('module_id')->with('module');


        if($request->method() === 'POST' ){
            // Validation
            $rules = [
                'role_id'	=> ['required'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                // query
                $this->data['rolePermissions'] = $this->auth->findRoleById($role_id);
                $query = $this->model::orderBy('section_name');
                if ($section_id) {
                    $query->where('id', $section_id);
                }
                if ($module_id) {
                    $query->where('module_id', $module_id);
                    $sectionsQuery->orderBy('section_name')->where('module_id', $module_id);
                }

                $this->data['sectionNames'] = $query->get();
            }
        }


        $this->data['role_id']          = $role_id;
        $this->data['section_id']       = $section_id;
        $this->data['module_id']        = $module_id;
        $this->data['sections']         = $sectionsQuery->get();

        $this->layout('index');
    }


    public function create(){
        $this->data = [
            'title'         => $this->title.' Create',
            'pageUrl'       => $this->bUrl.'/create',
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

    public function edit(Request $request){
        $this->data = [
            'title'         => $this->title.' Edit',
            'pageUrl'       => $this->bUrl.'/edit',
            'page_icon'     => '<i class="fas fa-edit"></i>',
            'modules'       =>  Module::where('status',1)->get(),
            'roles'         =>  Roles::get(),
            'section_id'    => $request['section_id'],
            'sections'      =>  [],
        ];

        $sections = [];
        if($request->method() === 'POST' ){
            $rules = [
                'module_id'	=> ['required'],
            ];
            $attribute =[
                'module_id'=> 'Module'
            ];
            $customMessages =[];
            $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $module_id  = $request['module_id'];
                $section_id = $request['section_id'];
                $this->data['module_id'] = $module_id;
                $query = $this->model::orderBy('section_name')->where('module_id', $module_id);
                $sections = $query->get();
                if (!empty($section_id)){
                    $query->whereIn('id', $section_id);
                }

                $this->data['sections'] = $query->get();
            }

        }
        $this->data['all_sections'] = $sections;
        $this->layout('edit');
    }

    public function update(Request $request, PermissionService $permissionService){

        $rules = [
            'module_id'	        => "required",
            'route_name'	    => "required",
            'id'	            => "required",
            'roles'	            => "required",
        ];
        $attribute =[
            'module_id'=> 'Module'
        ];
        $customMessages =[];
        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $permissionService->routeRegisterUpdate($request);
        return redirect()->back()->with('success', 'Successfully Updated.')->withInput();
    }

    public function sectionEdit(Request $request){
        $this->data = [
            'title'         => $this->title.' Section Edit',
            'pageUrl'       => $this->bUrl.'/section-edit',
            'page_icon'     => '<i class="fas fa-edit"></i>',
            'modules'       =>  Module::where('status',1)->get(),
            'sections'      =>  [],
            'section_id'    => $request['section_id'],
        ];
        $sections = [];
        if($request->method() === 'POST' ){
            $rules = [
                'module_id'	=> ['required'],
            ];
            $attribute =[
                'module_id'=> 'Module'
            ];
            $customMessages =[];
            $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $module_id  = $request['module_id'];
                $section_id = $request['section_id'];
                $this->data['module_id'] = $module_id;
                $query = $this->model::orderBy('section_name')->where('module_id', $module_id);
                $sections = $query->get();
                if (!empty($section_id)){
                    $query->whereIn('id', $section_id);
                }

                $this->data['sections'] = $query->get();
            }
            $this->data['all_sections'] = $sections;

        }
        $this->layout('section_edit');
    }

    public function sectionUpdate(Request $request, PermissionService $permissionService){

        $rules = [
            'module_id'	            => "required",
            'section_name.*'	    => "required",
        ];
        $attribute =[
            'module_id'=> 'Module'
        ];
        $customMessages =[];
        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $section_names = $request['section_name'];
        if (!empty($section_names)){
            foreach ($section_names as $key=>$value){
                if (!empty($value) && !empty($key)){
                   $check = $this->model::where('id','!=', $key)->where('section_name',$value)->first();
                   if (empty($check)){
                       $this->model::where('id', $key)->update(['section_name'=>$value]);
                   }else{
                     return redirect()->back()->with('error', 'The '.$value.' has already been taken')->withInput();
                   }
//
                }
            }
        }
        return redirect()->back()->with('success', 'Successfully Updated.')->withInput();
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

    public function getSectionsById(Request $request){
        $sections = $this->model::orderBy('section_name')->select('section_name', 'id')->where('module_id', $request['module_id'])->with('module')->get();
        $html = ' <option value=""> Select Section </option>';
        $section_id = $request['section_id'];
        if (!empty($sections)){
            foreach ($sections as $section){
//                $selected = !empty($section_id) && $section_id == $section->id?'selected':'';
                $selected = '';
                $html .='<option '.$selected.' value="'.$section->id.'"> '.$section->section_name.' </option>';
            }
        }
        return $html;
    }


    function routeRemove(Request $request){
        $id     = $request['id'];
	    $route  = $request['route'];
        $route_date =  $this->model::where('id',$id)->first();
        $actions = json_decode($route_date->section_action_route);
        if (!empty($actions->$route)) {
            unset($actions->$route);
        }
        $this->model::where('id',$id)->update(['section_action_route'=>json_encode($actions)]);
    }

    public function userModule(Request $request){
        $user_id = $request['id'];
        $user = User::where('id',$user_id)->first();
        $user_s = $this->auth->findUserById($request['id']);
        $module_name = $request['module_name'];
        $a_value = ($request->value == 1) ? true : false;
        if($user && $user_s){
            $modules =   ModuleSection::orderBy('module_id')->where('module_id', $module_name)->orderBy('section_name')->orderBy('id')->get();
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


    public function userPermission(Request $request){
        $user = $this->auth->findUserById($request['id']);
        $action = $request->action;
        $value = ($request->value == 1) ? true : false;
        if($user){
            $user->removePermission($action,$value)->save();
            $user->addPermission($action,$value)->save();
        }else{
            return false;
        }

    }

}
