<?php


namespace Modules\Scms\Traits;



use Modules\Scms\Models\ClassModel;
use Modules\Scms\Models\Exam;
use Modules\Scms\Models\ExamMark;
use Modules\Scms\Models\Grade;
use Modules\Scms\Models\Mark;
use Modules\Scms\Models\RuleMark;
use Modules\Scms\Models\RuleMarkManage;

trait ResultPublish
{
    public function __construct()
    {

    }

    public function resultPublish($request){
        $classId        = $request['class_id'];
        $examId         = $request['exam_id'];
        $year           = $request['year'];
        $ruleMarkManageId = $this->getRuleMarkManageId($request);
        $examMark       = $this->examMarkWhereQuery($request)->with('marks', 'marks.subject', 'marks.subject.childSubject')->first();
        $totalPass      = 0;
        $totalMarks     = 0;
        $totalMarks     = 0;
        $marks          = $examMark->marks;
        if (!empty($marks)){
            foreach ($marks as $mark){
                $ruleExamMakrs              = $this->getRuleMakr($ruleMarkManageId, $mark->subject_id);
                $rulesPassMark              = json_decode($ruleExamMakrs->rule_mark, true);
                $childSubjectId             = $mark->subject->childSubject->id??'';
                $studentExmMarks            = json_decode($mark->rules_marks, true);

                if (!empty($childSubjectId)){
                    $childSubjecExamMark    = $this->getExamChildSubjectMark($childSubjectId, $mark->exam_mark_id, $mark->student_id);

                    /*** Prent & child subject rule mark calculation */
                    $allRuleSubjecMarks     = [];
                    foreach ($studentExmMarks as $key=>$value){
                        $allRuleSubjecMarks[$key] = isset($childSubjecExamMark[$key]) && $childSubjecExamMark[$key]>0 && $value>0? $childSubjecExamMark[$key] + $value:0;
                    }

                    dd($allRuleSubjecMarks);

                }elseif ($mark->subject->subject_parent_id==null){

                }

                $gradPoint  = $this->gradePoint($ruleMakr->full_mark, $mark, $classId);
                $rulesMarks = json_decode($mark->rules_marks);
//                dd($rulesMarks);
            }
        }

        dd($examMark);

    }
    protected function examMarkWhereQuery($request){
        return ExamMark::where(['class_id'=>$request['class_id'], 'exam_id'=> $request['exam_id'], 'year'=>$request['year']]);
    }

    protected function getExamChildSubjectMark($childSubjectId, $examMarkId, $studentId){
        $makr = Mark::where(['subject_id'=>$childSubjectId, 'exam_mark_id'=>$examMarkId, 'student_id'=>$studentId])->pluck('rules_marks')->first();
        return  $makr?json_decode($makr, true):'';
    }

    protected function getRuleMarkManageId($request){
        $year           = $request['year'];
       return RuleMarkManage::where(['class_id'=>$request['class_id'], 'exam_id'=> $request['exam_id']])
            ->orWhere(function ($query) use ($year) {
                $query->where('start_year', '<', $year)
                    ->where('end_year', '>', $year);
            })->pluck('id')->toArray();

    }

    protected function getRuleMakr($manageId, $subjectId){
        return RuleMark::where(['rule_mark_manage_id'=>$manageId,'subject_id'=>$subjectId])->select('subject_id', 'full_mark', 'pass_mark', 'rule_mark')->first();
    }

    protected function gradePoint($fullMark, $mark, $classId){
        $outOfId = ClassModel::where('id', $classId)->pluck('out_of_id')->toArray();
        return Grade::where(['full_mark'=>$fullMark,'out_of_id'=>$outOfId, 'status'=>1])
            ->where(function ($query) use ($mark) {
                $query->where('mark_from', '<', $mark)
                    ->where('mark_upto', '>', $mark);
            })
            ->first();

    }

    protected function pushCheck(){

    }




}
