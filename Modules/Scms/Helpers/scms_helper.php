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


function getStudentSubjectCheck(array $studentInfo, object $subjectInfo, $opSubject=''){
    if (empty($studentInfo) || empty($subjectInfo)) return false;
    $subjectType        = $subjectInfo->subject_type;
    if ($subjectType ==1) return true;
    $optionalSubject    = !empty($opSubject)?json_decode($opSubject->o_subjects, true):[];
    $fourSubject        = !empty($opSubject)?$opSubject->four_subject:'';
    if ($subjectType ==2 && $studentInfo['group_id'] == $subjectInfo->group_id){
        return true;
    }elseif (!empty($opSubject) && ($subjectType ==3 || $subjectType ==4)){
        if ($subjectType ==3 && $subjectInfo->id == $fourSubject){
            return true;
        }elseif ($subjectType ==4 && array_key_exists($subjectInfo->id, $optionalSubject)){
            return true;
        }
       return false;
    }elseif ($subjectType ==5 && $studentInfo['religion_id'] == $subjectInfo->religion_id){
        return true;
    }elseif ($subjectType ==6 && $studentInfo['group_id'] == $subjectInfo->group_id){
        return true;
    }
    return false;

}

