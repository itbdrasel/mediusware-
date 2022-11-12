<?php

namespace Modules\Hrms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Roles;

class Department extends Model
{

    protected $table = 'hrms_departments';

    protected $fillable = [
        'name','role_id', 'order_by', 'is_teacher'
    ];

    public static $sortable = ['name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','role_id','order_by','is_teacher'];

    public function role(){
        return $this->hasOne(Roles::class, 'id','role_id');
    }
}
