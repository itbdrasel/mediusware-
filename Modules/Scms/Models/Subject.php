<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Gender;
use Modules\Core\Models\Religion;
use Modules\Hrms\Models\Employee;

class Subject extends Model
{

    protected $table = 'scms_subject';

    protected $fillable = [
        'name', 'subject_code', 'class_id', 'group_id', 'subject_parent_id', 'religion_id', 'gender_id', 'teacher_id', 'syllabus_from_year','syllabus_to_year', 'full_marks', 'subject_type', 'order_by', 'branch_id', 'vtype','status'
    ];
    public static $sortable = ['order_by','id','name','subject_code'];

    public static $filters = ['name', 'subject_code'];

    public static $required = ['name', 'subject_type','class_id'=>'class','teacher_id'=>'teacher'];

    public static $insertData = ['name', 'subject_code', 'class_id', 'group_id', 'subject_parent_id', 'religion_id', 'gender_id', 'teacher_id', 'syllabus_from_year','syllabus_to_year', 'full_marks', 'subject_type', 'order_by', 'status'];

    public function teacher(){
        return $this->hasOne(Employee::class, 'id', 'teacher_id');
    }
    public function subjectType(){
        return $this->hasOne(SubjectType::class, 'id', 'subject_type');
    }
    public function getClass(){
        return $this->hasOne(ClassModel::class, 'id', 'class_id');
    }
    public function group(){
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
    public function religion(){
        return $this->hasOne(Religion::class, 'id', 'religion_id');
    }
    public function gender(){
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }
    public function relativeSubject(){
        return $this->hasOne(Subject::class, 'id', 'subject_parent_id');
    }
    public function childSubject(){
        return $this->hasOne(Subject::class, 'subject_parent_id', 'id');
    }

}
