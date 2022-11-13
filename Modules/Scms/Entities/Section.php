<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hrms\Entities\Employee;

class Section extends Model
{

    protected $table = 'scms_sections';

    protected $fillable = [
        'name','nick_name','class_id','teacher_id','shift_id', 'order_by'
    ];

    public static $sortable = ['name', 'nick_name'];

    public static $filters = ['name','nick_name','order_by'];

    public static $required = ['name', 'class_id'=>'class'];

    public static $insertData = ['name','nick_name','class_id','teacher_id','shift_id', 'order_by'];

    public function teacher(){
        return $this->hasOne(Employee::class, 'id','teacher_id');
    }

    public function shift(){
        return $this->hasOne(Shift::class, 'id','shift_id');
    }
}
