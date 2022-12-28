<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Hrms\Entities\Employee;

class Subject extends Model
{

    protected $table = 'scms_subject';

    protected $fillable = [
        'name', 'subject_code', 'class_id', 'group_id', 'subject_parent_id', 'religion_id', 'gender_id', 'teacher_id', 'syllabus_change_id', 'full_marks', 'subject_type', 'order_by', 'status'
    ];
    public static $sortable = ['id','name','subject_code'=>'code'];

    public static $filters = ['name', 'subject_code'];

    public static $required = ['name', 'subject_type','class_id'=>'class','teacher_id'=>'teacher'];

    public static $insertData = ['name', 'subject_code', 'class_id', 'group_id', 'subject_parent_id', 'religion_id', 'gender_id', 'teacher_id', 'syllabus_change_id', 'full_marks', 'subject_type', 'order_by', 'status'];

    public function teacher(){
        return $this->hasOne(Employee::class, 'id', 'teacher_id');
    }
    public function subjectType(){
        return $this->hasOne(SubjectType::class, 'id', 'subject_type');
    }
    public function getClass(){
        return $this->hasOne(ClassModel::class, 'id', 'class_id');
    }

}
