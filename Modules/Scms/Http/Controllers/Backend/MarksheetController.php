<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Enroll;
use Modules\Scms\Models\Exam;
use Modules\Scms\Models\Student;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Models\ExamRule;

use Modules\Scms\Traits\Marksheet;
use Validator;

class MarksheetController extends Controller
{
    use Marksheet;

    public function __construct(){
        parent::__construct();
        $this->model            = ExamRule::class;
        $this->bUrl             = $this->moduleName.'/marksheet';
        $this->title            = 'Marksheet';
    }


    public function layout($pageName){
        echo $this->getLayout('marksheet',$pageName);
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(){
        $this->data = [
            'title'         =>  $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-user-graduate"></i>',
            'students'      => $this->getStudents(),
            'exams'         => Exam::where($this->getWhere())->where('type',1)->orderBy('order_by')->get(),
            'objData'       => ''
        ];

        $this->layout('index');
    }


    public function marksheet(Request $request){

        $year           = getRunningYear();
        $enroll         = Enroll::where(['student_id'=>$request['student_id'], 'year'=> $year])->first();
        $classId        = $enroll->class_id;

        $rules          = $this->validationRules($request, $classId);
        $attribute = [
            "exam_id"               => "exam",
            "student_id"            => "student",
        ];
        $request->validate($rules,[], $attribute);

        $student            = $enroll->student;
        $optionalSubject    = $student->optionalSubject->select('o_subjects','four_subject')->first();
        $studentResult      = $this->studentResult($request, $classId);
        $subjectsMark       = $studentResult['subjectMarks'];
        $studentMark        = $studentResult['studentsMark'];
        $rulSubjects        = $this->getRuleSubject($classId, $request['exam_id']);

        $this->data = [
            'title'             => $this->title.' Print',
            'pageUrl'           => $this->bUrl.'/print',
            'student'           => $student,
            'enroll'            => $enroll,
            'subjects'          => $rulSubjects,
            'optionalSubject'   => $optionalSubject,
            'studentMark'       => $studentMark,
            'subjectsMark'      => $subjectsMark,
            'rules'             =>  $this->getRules($rulSubjects)
        ];

        $this->layout('print');
    }




}
