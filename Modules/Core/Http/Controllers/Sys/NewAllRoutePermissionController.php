<?php

namespace Modules\Core\Http\Controllers\Sys;
use Illuminate\Routing\Controller;

use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class NewAllRoutePermissionController extends Controller
{

    private $moduleName;
    private $bUrl;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth = $auth;

        $this->tableId = 'roles';
        $this->moduleName = 'system/core';
        $this->bUrl = $this->moduleName.'/permissions';
    }

    public function store(){
        DB::table('tbl_module_sections')->truncate();
        DB::table('roles')->update(['permissions'=>null]);
        $name = Route::getRoutes();
        $sl =0;
        foreach ($name as $value) {
            if (!empty($value->getName())) {
                $routeName  = $value->getName();
                $route_names = explode('.',$routeName);
                if ($route_names[0] !='debugbar' && $route_names[0] !='ignition' && $route_names[0] !='sanctum') {
                    $module_name = $route_names[0] ?? '';
                    $sectionName = $route_names[1] ?? '';
                    if (empty($sectionName)){
                        $sectionName =  $module_name;
                    }
                    $sectionName = ucwords(str_replace(['_','-'],' ',$sectionName));
                    $module_name = ucwords(str_replace(['_','-'],' ',$module_name));
                    if ($sectionName != 'Ajax') {
                        $sl++;
                        $roles =['1']; // can be multiple [array]
                        $routeWithRoles = json_encode([$routeName => $roles]);
                        // check if the section name exist
                        $data = DB::table('tbl_module_sections')->where(['section_name'=> $sectionName])
                            ->where('section_module_name', $module_name)->first();
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
                            DB::table('tbl_module_sections')->where('section_name', $sectionName)->update( $routeData);
                        }else{
                            DB::table('tbl_module_sections')->insert($routeData);
                        }
                        $role = $this->auth->findRoleById(1);
                        if($role){
                            $role->addPermission($routeName,true)->save();
                        }

                    }
                }
            }
        }
        dd('Total Route '.$sl.' Successful. Permission Add');
        return redirect()->back()->with('success', 'Total Route '.$sl.' Successful. Permission Add');

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
                echo $rul.' ('.$routeName.')<br><br>';
            }

        }
        dd('Total Route '.$sl.' Successful. Permission Add');
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
