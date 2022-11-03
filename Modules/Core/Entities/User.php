<?php

namespace Modules\Core\Entities;



use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;

class User extends SentinelUser
{

    protected $fillable = [
        'full_name', 'user_name', 'phone', 'email', 'last_login', 'branch_id','employee_id', 'permissions', 'm_permission', 'password','directory','email_verified_at', 'remember_token'
    ];

    public static $sortable = ['id' => 'id', 'name' => 'full_name', 'role'=>'roles.name','login'=>'last_login'];

    public static $filters = ['full_name','phone','email'];

    public function role(){
        return $this->hasOne(RoleUser::class,'user_id', 'id');
    }

    public function branch(){
        return $this->hasOne(Branch::class,'id', 'branch_id');
    }

    public function activation(){
        return $this->hasOne(Activation::class,'user_id', 'id');
    }

}
