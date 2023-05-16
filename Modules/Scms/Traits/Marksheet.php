<?php


namespace Modules\Scms\Traits;




use Modules\Scms\Models\ExamMark;
use Modules\Scms\Models\ExamRule;
use Modules\Scms\Models\RuleMarkManage;
use Modules\Scms\Models\RulesGroup;
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
            ->with('subject.childSubject')
            ->whereHas('subject', function($query) {
                $query->whereNull('subject_parent_id');
                $query->where('status',1);
                $query->orderBy('order_by');
            })
//            ->select('subject_id','full_mark', 'pass_mark', 'rule_mark','subject_type', 'status')
            ->get()
            ->sortBy(function ($item) {
                return optional($item->subject)->order_by;
            });

    }

    public function getStudentSubject($ruleSubjects){
        if (!empty($ruleSubjects)){
            foreach ($ruleSubjects as $ruleSubject){
                $subject = $ruleSubject->subject;
                $childSubject = $ruleSubject->childSubject??'';
                dd($subject);


            }
        }

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

    public function getExamRules($classId, $examId){
        $runnintYear    = getRunningYear();
        $start_year     = substr($runnintYear, -4);
        $end_year       = $start_year;
        $rulesGroup = RulesGroup::where($this->getWhere())->where(['class_id' => $classId, 'exam_id' => $examId])->with('ruleManages');
        if ($start_year && $end_year) {
            $rulesGroup->where('start_year', '<=', $end_year)
                ->where('end_year', '>=', $start_year);
        } elseif ($end_year) {
            $rulesGroup->where('end_year', $end_year);
        } elseif ($end_year) {
            $rulesGroup->where('start_year', $start_year);
        }
        $rules = $rulesGroup->first();
        $this->data['rules'] = $rules?->ruleManages()->with('ruleName')->get();
    }

    public function getRules($subjects){
        if (isset($subjects[0]) && !empty($subjects[0])){
            $ruleIds = array_keys(json_decode($subjects[0]->rule_mark, true));
            return ExamRule::select('id', 'code')->whereIn('id', $ruleIds)->orderBy('order_by')->get();
        }

    }

    public function validationRules($request, $classId){
       return [
            "exam_id"               => "required",
            "student_id"            => ["required", function ($attribute, $value, $fail) use ($request, $classId) {
                $vtype              = getVersionType();
                $year               = getRunningYear();
                $where              = ['vtype'=> $vtype, 'year'=> $year];
                $resultPublish      = \Modules\Scms\Models\ResultPublish::where($where)->where(['class_id'=> $classId, 'exam_id'=> $request['exam_id']])->first();
                if (empty($resultPublish)){
                    $fail(__('Exam result not published'));
                }
            }],
        ];

    }

    public function studentResult($request, $classId){

        $studentId          = $request['student_id'];
        $examId             = $request['exam_id'];
        $vtype              = getVersionType();
        $year               = getRunningYear();

        $examMark           = ExamMark::where(['exam_id'=>$examId, 'class_id'=> $classId, 'year'=>$year, 'vtype'=>$vtype])->with('marks', 'studentsMarks')->first('id');

        $subjectMarks       = $examMark->marks()->where(['student_id'=>$studentId])
            ->select('subject_id','rules_marks','total_mark','letter_grade', 'grade_points', 'is_pass')
            ->get()->toArray();

        $idArray            = array_column($subjectMarks, 'subject_id');
        $subjectMarks       = array_combine($idArray, $subjectMarks);

        $studentsMark      = $examMark->studentsMarks()->where(['student_id'=>$studentId])->select('letter_grade', 'grade_points')->first();

        return ['subjectMarks'=>$subjectMarks, 'studentsMark'=>$studentsMark];

    }

}
