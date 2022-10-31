<?php

namespace Modules\Hrms\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $table = 'hrms_employees';

    protected $fillable = [
        'id_number', 'name', 'department_id', 'designation_id', 'father_name', 'mother_name', 'birth_date', 'joining_date', 'release_date', 'gender_id', 'religion_id', 'marital_state', 'mobile', 'email', 'nid', 'tin', 'basic_salary', 'total_salary', 'present_address', 'permanent_address', 'language', 'education', 'seniority', 'blood_group_id', 'picture', 'increment_status', 'document', 'social_media', 'salary_status', 'is_website', 'status'
    ];

    public static $sortable = ['id','name','id_number'];

    public static $filters = ['name','id_no','mobile'];

    public static $required = ['name','id_number','mobile','gender_id'=>'Gender','department_id'=>'department', 'basic_salary'=>'Basic salary', 'email'];

    public static $insertData = ['id_number', 'name', 'department_id', 'designation_id', 'father_name', 'mother_name', 'gender_id', 'religion_id', 'marital_state', 'mobile', 'email', 'nid', 'tin', 'basic_salary', 'total_salary', 'present_address', 'permanent_address', 'seniority', 'blood_group_id', 'increment_status', 'salary_status', 'is_website', 'status'];

    public function department(){
        return $this->hasOne(Department::class, 'id','department_id');
    }

    public function designation(){
        return $this->hasOne(Designation::class, 'id','designation_id');
    }


}
