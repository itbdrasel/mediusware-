<?php

namespace Modules\Core\Http\Controllers\Sys;
use Illuminate\Routing\Controller;

use Modules\Core\Entities\ModuleSection;
use Modules\Core\Entities\Roles;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Support\Facades\Route;

class NewAllRoutePermissionController extends Controller
{

    private $moduleName;
    private $bUrl;
    private $model;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;

        $this->tableId = 'roles';
        $this->moduleName = 'system/core';
        $this->model        = ModuleSection::class;
        $this->bUrl = $this->moduleName.'/permissions';
    }

    public function store(){
//        $this->model::truncate();
//        Roles::updated(['permissions'=>null]);
        $name   = Route::getRoutes();
        $sl     = 0;
        $old_section_name ='';
        foreach ($name as $value) {
            $route_name = $value->getName();
            if (!empty($route_name)) {
                $route_explode = explode('.', $route_name);
                if (!empty($route_name) && $route_explode[0] != 'debugbar' && $route_explode[0] != 'ignition' && $route_explode[0] != 'sanctum') {
                    $sl++;
                    $module_name = $route_explode[0] ?? '';
                    $section_name = $route_explode[1] ?? '';
                    if (empty($section_name)){
                        $section_name    = $module_name;
                    }
                    $section_name    = ucwords(str_replace(['_','-'],' ',$section_name));
                    $module_name    = str_replace(['_','-'],' ',$module_name);
                    if (!empty($section_name) && !empty($module_name)){
                        $module_id          = $this->getModuleNameById($module_name);
                        $data               = $this->model::where(['section_name'=> $section_name, 'module_id'=>$module_id])->first();
                        $roles              = ['1'];
                        $role               = $this->auth->findRoleById(1);
                        if (!empty($data)){
                            $action_route = json_decode($data->section_action_route, true);
                            if (!isset($action_route[$route_name])) {
                                if (!empty($old_section_name) && $old_section_name !=$section_name){
                                    $role_with_route =[];
                                }
                                $role_with_route[$route_name] = $roles;
                                if($role){
                                $role->addPermission($route_name,true)->save();
                                }
                            }

                        }else{
                            $routeData['section_roles_permission'] = '["1"]';
                            if (!empty($old_section_name) && $old_section_name !=$section_name){
                                $role_with_route =[];
                            }
                            $role_with_route[$route_name] =  $roles;
                        }

                        $routeData['section_name']          = $section_name;
                        $routeData['module_id']             = $module_id;

                        $old_section_name = $section_name;
                        if (isset($role_with_route) && !empty($role_with_route)){
                            $routeData['section_action_route']  = json_encode($role_with_route);
                            if (!empty($data)) {
                            $this->model::where('section_name', $section_name)->update( $routeData);
                            }else{
                                $this->model::insert($routeData);
                            }
                        }

                    }
                }
            }

        }
        dd('Total Route '.$sl.' Successful. Permission Add');
        return redirect()->back()->with('success', 'Total Route '.$sl.' Successful. Permission Add');
    }

    public function getModuleNameById($name){
        $modules = $this->allModuleName();
        return $modules[$name];
    }

    public function allModuleName(){
        return [
            'core'=>1
        ];
    }


    public function getAllRoutes(){
        $name = Route::getRoutes();
        $sl =0;
        foreach ($name as $value) {
            $rul = $value->uri();
            $routeName = $value->getName();
            $route_names= explode('.',$routeName);
            if (!empty($routeName) && $route_names[0] !='debugbar' && $route_names[0] !='ignition' && $route_names[0] !='sanctum') {
                $sl++;
                $routeName = $value->getName();
                echo '<p style="margin: 10px 40px; font-size: 25px">('.$sl.') '.$rul. ' <spen style="background: #cccccc7a;padding: 0px 6px;
    border-radius: 5px; color: #2e2c2c;">(' .$routeName.')</spen></p>';
            }

        }
        dd('Total Route '.$sl.' ');
    }




}
