<?php
use Modules\Hrms\Models\Employee;
use Modules\Scms\Models\ClassModel;

function getTeacher(){
  return  Employee::rightJoin('hrms_departments', 'hrms_employees.department_id', '=', 'hrms_departments.id')
        ->where('is_teacher',1)
        ->select('hrms_employees.name', 'hrms_employees.id')
        ->get();
}
function getClass($where=''){
    $query = ClassModel::orderBy('order_by');
    if (!empty($where)){
        $query->where($where);
    }
  return $query->get();
}

function getTopBerYear($setFormat=''){
    return getFormatYear(getRunningYear(), $setFormat);
}

function getFormatYear($year, $setFormat=''){
    $year_format    = config('sc_setting.r_year_format');
    if ($year_format ==1 || $setFormat) {
        return substr($year, 5,14);
    }
    return $year;
}

function getRunningYear(){
    $running_year   = config('sc_setting.running_year');
    return $running_year;
}

function getDbRunningYear($year){
    $year2   = substr($year, -4);
    $year1  = $year2-1;
    return "{$year1}-{$year2}";
}
function getVersionType(){
    return config('sc_setting.vtype');
}

function getBranchId(){
    return session()->get('_branch_id');
}

