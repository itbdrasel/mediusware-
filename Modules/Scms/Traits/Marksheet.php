<?php


namespace Modules\Scms\Traits;



use Modules\Scms\Models\RuleMarkManage;
use Modules\Scms\Models\Student;
use Modules\Scms\Models\Subject;

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
        return $ruleMarkQuery->ruleMarks()
            ->with(['subject' => function ($q) {
                $q->orderBy('order_by');
            }])
            ->select('subject_id', 'full_mark', 'pass_mark', 'rule_mark', 'status')
            ->get()
            ->sortBy(function ($item) {
                return optional($item->subject)->order_by;
            });

    }

    public function getStudents(){
        $branch_id = getBranchId();
        return  Student::select('id', 'name', 'id_number')
            ->where( ['branch_id'=>$branch_id,'vtype'=>getVersionType()])->get();
    }

    public function getStudentById($id){
        return  Student::where( ['id'=>$id])->first();
    }

    public function getSubjectsByClassId($id){
        $branchId = getBranchId();
        return  Subject::select('id', 'name', 'subject_code', 'group_id', 'subject_parent_id', 'religion_id', 'gender_id', 'full_marks','subject_type')
            ->where(['class_id'=>$id, 'branch_id'=>$branchId,'vtype'=>getVersionType(), 'status'=>1])
            ->with('childSubject')
            ->whereNull('subject_parent_id')
            ->orderBy('order_by')->get();
    }

}
