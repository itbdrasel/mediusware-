<?php

namespace Modules\Core\Services;

use Modules\Core\Entities\ModuleSection;
use Modules\Core\Repositories\AuthInterface as Auth;

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
        $roles              = $request['role']; // can be multiple [array]
        $module_id          = $request['module_name'];
        $routeWithRoles     = json_encode( [$routeName => $roles ] );

        $data = $this->model::where(['section_name'=> $sectionName])->where('module_id', $module_id)->first();
        if (!empty($data)) {
            $getRoutes = $data->section_action_route;
            $routeNames = json_decode($getRoutes, true);

            if (array_key_exists($routeName, $routeNames)) {
                $routeNames[$routeName] = $roles;  // update existing route.
            } else {
                $routeNames += [$routeName => $roles]; // append new route for existing section
            }

            $routeWithRoles = $routeNames;
        } else {
            $roles_permission = trim($this->arrayValue($roles), ',"');
            $routeData['section_roles_permission'] = '["' . $roles_permission . '"]';
        }
        $routeData['section_name']          = $sectionName;
        $routeData['module_id']             = $module_id;
        $routeData['section_action_route']  = $routeWithRoles;

        if (!empty($data)) {
            $this->model::where('section_name', $sectionName)->update($routeData);
        }else{
            $this->model::insert($routeData);
        }
        $this->rolePermission($roles, $routeName);
    }

    public function routeRegisterUpdate($request){
        $section_id         = $request['id'];
        if (!empty($section_id) && count($section_id) >0){
            foreach ($section_id as $key=>$value){
                $id                 = $value;
                $routeNames         = $request['route_name'][$key];
                $routeWithRoles     = [];
                $section_roles      = [];
                if (!empty($routeNames) && count($routeNames) >0) {
                    foreach ($routeNames as $rKey=>$routeName){
                        $roles = $request['roles'][$key][$rKey];
                        if(!in_array($roles, $section_roles) ){
                            if (count($section_roles) >0){
                                $section_roles = array_unique(array_merge($section_roles,$roles));
                            }else{
                                $section_roles = $roles;
                            }

                        }

                        $routeWithRoles[$routeName] = $roles;
                        $this->rolePermission($roles, $routeName);
                    }
                }
                $routeData['section_action_route']  = json_encode($routeWithRoles);
                $routeData['section_roles_permission']  = json_encode($section_roles);
                $this->model::where('id', $id)->update($routeData);
            }
        }
    }

    public function rolePermission($roles, $routeName){
        if (!empty($roles)) {
            if (is_array($roles)) {
                foreach ($roles as $role){
                    $this->addPermission($role, $routeName);
                }

            }else{
                $this->addPermission($roles, $routeName);
            }
        }
    }


    public function addPermission($role_id, $routeName){
        $role = $this->auth->findRoleById($role_id);
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
                        $fail(__('The route name is not exist.'));
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
