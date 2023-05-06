<?php


namespace Modules\Scms\Traits;

use Modules\Scms\Models\ClassModel;
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
        $studentData    = [];
        if (!empty($marks)){
            foreach ($marks as $mark){
                $studentExmMarks            = json_decode($mark->rules_marks, true);

                $examSubjectRules           = $this->getRuleMakr($ruleMarkManageId, $mark->subject_id);
                $rulesPassMark              = json_decode($examSubjectRules->rule_mark, true);

                $childSubjectId             = $mark->subject->childSubject->id??'';

                if (!empty($childSubjectId)){
                    $studentChildSubExamMark    = $this->getExamChildSubjectMark($childSubjectId, $mark->exam_mark_id, $mark->student_id);
                    $ruleChildExamMarks         = $this->getRuleMakr($ruleMarkManageId, $childSubjectId);
                    $rulesChildPassMark         = json_decode($ruleChildExamMarks->rule_mark, true);

                    $checkExamPass              = $this->checkExamPass($rulesChildPassMark, $studentChildSubExamMark);
                    $childPassStatus            = $checkExamPass['passStatus'];

                    /*** Prent & child subject rule mark calculation */
                    $allRuleSubjecMarks     = [];
                    foreach ($studentExmMarks as $key=>$value){
                        $allRuleSubjecMarks[$key] = isset($studentChildSubExamMark[$key]) && $studentChildSubExamMark[$key]>0 && $value>0? $studentChildSubExamMark[$key] + $value:0;
                    }
                    $studentResult  = $this->getStudentExamResult($examSubjectRules, $rulesPassMark, $allRuleSubjecMarks, $classId);
                    $passStatus     = $studentResult['passStatus'];
       
                    if ($childPassStatus && $passStatus){

                    }else{
                        $studentResult['passStatus']= false;
                    }
                    $this->updateMark($mark->id, $studentResult);

                }elseif ($mark->subject->subject_parent_id==null){
                    $studentResult  = $this->getStudentExamResult($examSubjectRules, $rulesPassMark, $rulesPassMark, $classId);
                    $passStatus     = $studentResult['passStatus'];
                    if ($passStatus){

                    }else{

                    }

                }

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

    /**
     * Calculates the grade point based on the full mark, obtained mark, and class ID.
     *
     * @param float $fullMark The full mark for the subject.
     * @param float $mark The mark obtained by the student.
     * @param int $classId The ID of the class.
     *
     * @return Grade|null The grade point object, or null if no matching grade point is found.
     */

    protected function gradePoint($fullMark, $mark, $classId){
        $outOfId = ClassModel::where('id', $classId)->pluck('out_of_id')->toArray();
        return Grade::where(['full_mark'=>$fullMark,'out_of_id'=>$outOfId, 'status'=>1])
            ->select('name','grade_point')
            ->where(function ($query) use ($mark) {
                $query->where('mark_from', '<', $mark)
                    ->where('mark_upto', '>', $mark);
            })
            ->first();

    }




    /**
     * Checks if a student has passed an exam based on the given pass rules and student marks.
     *
     * @param array $passRules An array of pass rules.
     * @param array $studentRulesMark An array of student rules marks.
     * @param bool $returnOnlyStatus Flag to indicate whether to return only the pass status or both mark and status.
     *
     * @return array|bool An array containing the total mark and pass status, or just the pass status if $returnOnlyStatus is true.
     */
    protected function checkExamPass($passRules, $studentRulesMark, $returnOnlyStatus = false)
    {
        $totalMark = 0;
        $passStatus = true;

        foreach ($studentRulesMark as $ruleId => $mark) {
            if (array_key_exists($ruleId,$passRules)){
                if ($passRules[$ruleId] > $mark) {
                    $passStatus = false;
                }
            } else {
                $passStatus = false;
            }
            $totalMark += $mark;
        }

        if ($returnOnlyStatus) {
            return $passStatus;
        }

        return [
            'totalMark'     => $totalMark,
            'passStatus'    => $passStatus,
        ];
    }

    /**
     * Gets the student's exam result based on the given exam rule, pass marks, exam marks, and class ID.
     *
     * @param array $examRule An array of exam rules.
     * @param array $rulesPassMark An array of pass marks.
     * @param array $rulesExamMarks An array of exam marks.
     * @param int $classId The ID of the student's class.
     *
     * @return array An array containing the pass status, subject mark, grade, and point.
     */

    protected function getStudentExamResult($examRule, $rulesPassMark, $rulesExamMarks, $classId){
        $checkExamPass      = $this->checkExamPass($rulesPassMark, $rulesExamMarks);
        $passStatus         = $checkExamPass['passStatus'];
        $subjectMark        = $checkExamPass['totalMark'];
        $grade              = 'F';
        $point              = '0.00';
        if ($passStatus && $subjectMark >=$examRule->pass_mark){
            $gradePoint     =  $this->gradePoint($examRule->full_mark, $subjectMark, $classId);
            $grade          = $gradePoint->name;
            $point          = $gradePoint->grade_point;
            if ($point <1){
                $passStatus = false;
            }
        }

        return [
            'passStatus'    => $passStatus,
            'subjectMark'   => $subjectMark,
            'grade'         => $grade,
            'point'         => $point,
        ];
    }

    protected function updateMark($markId, $studentResult){
        $markData = [
            'total_mark'    => $studentResult['subjectMark'],
            'letter_grade'  => $studentResult['grade'],
            'grade_points'  => $studentResult['point'],
            'is_pass'       => $studentResult['passStatus']?1:0,
        ];
        Mark::where('id', $markId)->update($markData);

    }


    /**
     "passStatus" => true
    "subjectMark" => 70
    "grade" => "D"
    "point" => "1.00"
     */

}
