<?php

namespace Modules\Hrms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Roles;

class Department extends Model
{

    protected $table = 'hrms_departments';

    protected $fillable = [
        'name','role_id', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','role_id','order_by'];

    public function role(){
        return $this->hasOne(Roles::class, 'id','role_id');
    }
}
