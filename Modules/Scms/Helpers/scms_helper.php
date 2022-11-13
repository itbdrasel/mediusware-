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
