<?php

namespace Modules\Core\Entities;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'user_name', 'phone', 'email', 'last_login', 'branch_id', 'permissions', 'm_permission', 'password', 'email_verified_at', 'remember_token'
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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native hall_types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
