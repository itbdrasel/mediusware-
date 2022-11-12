<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hrms\Entities\Employee;

class ClassModel extends Model
{

    protected $table = 'scms_class';

    protected $fillable = [
        'name', 'teacher_id', 'order_by'
    ];

    public static $sortable = ['name'];

    public static $filters = ['name', 'order_by'];

    public static $required = ['name', 'teacher_id'=>'teacher'];

    public static $insertData = ['name', 'teacher_id', 'order_by'];

    public function teacher(){
        return $this->hasOne(Employee::class, 'id','teacher_id');
    }
}
