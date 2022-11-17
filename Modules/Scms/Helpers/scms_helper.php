<?php
use Modules\Hrms\Entities\Employee;
use Modules\Scms\Entities\ClassModel;

function getTeacher(){
  return  Employee::rightJoin('hrms_departments', 'hrms_employees.department_id', '=', 'hrms_departments.id')
        ->where('is_teacher',1)
        ->select('hrms_employees.name', 'hrms_employees.id')
        ->get();
}
function getClass(){
  return ClassModel::orderBy('order_by')->get();
}

function getTopBerYear(){
    $running_year   = getRunningYear();
    $year_format    = config('sc_setting.r_year_format');
    if ($year_format ==1) {
        return substr($running_year, 5,14);
    }
    return $running_year;
}

function getRunningYear(){
    $running_year   = config('sc_setting.running_year');
    return $running_year;
}
