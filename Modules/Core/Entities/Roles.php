<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'slug', 'name', 'permissions', 'redirect_url', 'module_code'
    ];

    public static $sortable = ['id'=>'id','name'=>'name','slug'=>'slug'];

    public static $filters = ['name'];

    public static $required = ['name', 'slug','redirect_url'];
    public static $attribute = ['name'=>'Role Name', 'slug'=>'Role Slug','redirect_url'=>'Redirect'];

    public static $insertData = ['slug', 'name', 'permissions', 'redirect_url', 'module_code'];
}
