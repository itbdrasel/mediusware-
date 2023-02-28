<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'slug', 'name', 'permissions', 'redirect_url', 'order_by','active_directory', 'active_branch'
    ];

    public static $sortable = ['id','name','slug'];

    public static $filters = ['name'];

    public static $required = ['name'=>'Role Name', 'slug'=>'Role Slug','redirect_url'=>'Redirect','order_by'];

    public static $insertData = ['slug', 'name', 'redirect_url','order_by'];
}
