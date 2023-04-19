<?php


namespace Modules\Scms\Traits;



use Modules\Scms\Models\RuleMarkManage;
use Modules\Scms\Models\Student;

trait Marksheet
{
    public function __construct()
    {

    }

    public function getWhere()
    {
        return ['vtype' => getVersionType(), 'branch_id' => getBranchId()];
    }





    public function getRuleSubject($class_id, $exam_id)
    {
        $runnintYear    = getRunningYear();
        $start_year     = substr($runnintYear, -4);
        $end_year       = $start_year;

        $ruleMarkQuery = RuleMarkManage::where(['class_id' => $class_id, 'exam_id' => $exam_id])
            ->select('id')
            ->orWhere(function ($query) use ($start_year, $end_year) {
                $query->where('start_year', '<=', $end_year)
                    ->where('end_year', '>=', $start_year)
                    ->orWhere(function ($query) use ($start_year) {
                        $query->where(['end_year' => $start_year]);
                    });
            })->orWhere(function ($query) use ($start_year){
                $query->where(['start_year' => $start_year]);
            })->orWhere(function ($query) use ($end_year){
                $query->where(['end_year' => $end_year]);
            })
            ->first();

        return $ruleMarkQuery->ruleMarks()->with('subject')->select('subject_id','full_mark', 'pass_mark', 'rule_mark','status')->get();

    }

    public function getStudent(){
        $branch_id = getBranchId();
        return  Student::select('id', 'name', 'id_number')
            ->where( ['branch_id'=>$branch_id,'vtype'=>getVersionType()])->first();
    }

}
