<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Hrms\Models\Employee;

class ClassModel extends Model
{

    protected $table = 'scms_class';

    protected $fillable = [
        'name', 'teacher_id', 'order_by','branch_id','out_of_id','vtype'
    ];

    public static $sortable = ['name'];

    public static $filters = ['name', 'order_by'];

    public static $required = ['name', 'teacher_id'=>'teacher'];

    public static $insertData = ['name', 'teacher_id','out_of_id', 'order_by'];

    public function teacher(){
        return $this->hasOne(Employee::class, 'id','teacher_id');
    }

    public function sections(){
       return $this->hasMany(Section::class, 'class_id','id');
    }
}
