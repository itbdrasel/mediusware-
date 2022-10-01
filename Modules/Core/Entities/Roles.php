<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'slug', 'name', 'permissions', 'redirect_url', 'order_by','module_code'
    ];

    public static $sortable = ['id','name','slug'];

    public static $filters = ['name'];

    public static $required = ['name'=>'Role Name', 'slug'=>'Role Slug','redirect_url'=>'Redirect','order_by'];

    public static $insertData = ['slug', 'name', 'permissions', 'redirect_url','order_by', 'module_code'];
}
