<?php


namespace App\Services;

use App\Helpers\Logs;
use App\Models\ModuleSection;

use App\Repositories\AuthInterface as Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class PermissionService

{

    private $model;
    private $tableId;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;
        $this->model = ModuleSection::class;
        $this->tableId = 'section_id';
    }



    public function routeRegister($request){
        $sectionName        = $request['section_name'];
        $routeName          = $request['route_name'];
        $actionName         = substr($routeName, strrpos($routeName, '.') );
        $actionName         = trim($actionName,'.');
        $roles              = $request['role']; // can be multiple [array]
        $module_name        = $request['module_name'];
        $routeWithRoles     = json_encode( [$routeName => $roles ] );

        $data = $this->model::where(['section_name'=> $sectionName])->where('section_module_name', $module_name)->first();
        if (!empty($data)) {
            $getRoutes = $data->section_action_route;
            $routeNames = json_decode($getRoutes, true);
            if (array_key_exists($routeName, $routeNames)) {
                $routeNames[$routeName] = $roles; // update existing route.
            } else {
                $routeNames += [$routeName => $roles]; // append new route for existing section
            }
            $routeWithRoles = $routeNames;
        } else {
            $roles_permission = trim($this->arrayValue($roles), ',"');
            $routeData['section_roles_permission'] = '["' . $roles_permission . '"]';
        }
        $routeData['section_name'] = $sectionName;
        $routeData['section_module_name'] = $module_name;
        $routeData['section_action_route'] = $routeWithRoles;
        if (!empty($data)) {
            $this->model::where('section_name', $sectionName)->update( $routeData);
            $log_title = 'Route (Section : '.$sectionName  .') was update by '. $this->auth->getUser()->full_name;
            Logs::create($log_title,'route_section_update');
        }else{
            $this->model::insert($routeData);
            $log_title = 'Route (Section : '.$sectionName  .') was update by '. $this->auth->getUser()->full_name;
            Logs::create($log_title,'route_section_update');
        }
        $role = $this->auth->findRoleById($roles);
        if($role){
            $role->addPermission($routeName,true)->save();
        }

    }



    public function routeValidation($request){

        $rules = [
            'module_name'	=> 'required',
            'section_name'	=> 'required',
            'route_name'	=> ['required',
                function ($attribute, $value, $fail)  use ($request) {
                    if ( !Route::has($value) ) {
                        $fail(__('The '.$attribute.' is not exist.'));
                    }
                },
            ],
            'role'			=> 'required'

        ];

        $attribute = [
            'module_name'   => 'Module Name',
            'section_name'  => 'Section Name',
            'route_name'    => 'Route Name',
            'role'          => 'Role'
        ];

        $customMessages = [];

       return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }

    function array_flatten($array) {
        $result = array();
        foreach ($array as $key => $value) {
            $result[$key] = $value;
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


}
