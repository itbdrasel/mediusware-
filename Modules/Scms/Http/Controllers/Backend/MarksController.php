<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Exam;
use Modules\Scms\Models\ExamMark;
use Modules\Scms\Models\Mark;
use Modules\Scms\Models\Section;
use Modules\Scms\Models\Subject;
use Modules\Scms\Services\Backend\Controller;

use Illuminate\Http\Request;


use Modules\Scms\Traits\Marks;
use Validator;

class MarksController extends Controller
{
    use Marks;

    public function __construct(){
        parent::__construct();
        $this->model            = Mark::class;
        $this->bUrl             = $this->moduleName.'/marks';
        $this->title            = 'Mark';
    }

    public function layout($pageName){
        echo $this->getLayout('marks',$pageName);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){

        $this->data                 = $this->crudServices->getIndexData($request, ExamMark::class, 'year' , ['marks','marks.subject', 'className', 'exam'], $this->getWhere());
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
        if ($request->ajax() || $request['ajax']){
            return $this->layout('data');
        }
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(Request $request){

        $this->data = [
            'title'         => "Add New {$this->title}",
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'allClass'      => getClass(),
            'exams'         => Exam::where($this->getWhere())->where('type',1)->orderBy('order_by')->get(),
            'objData'       => ''
        ];

        if ($request['_method'] === 'POST') {

            $this->indexValidation($request);
            $classId = $request['class_id'];
            $examId = $request['exam_id'];
            $rulesGroup = $this->getRulesGroup($classId, $examId);
            if (empty($rulesGroup) || empty($rulesGroup->ruleManages)){
                return redirect()->back()->withErrors('In this class, exam rule are not created.')->withInput();
            }
            $rules      = $rulesGroup->ruleManages()->with('ruleName')->get();
            $students   = $this->getStudents($request);
            if ($students->isEmpty()){
                return redirect()->back()->withErrors('In this class, student are not found.')->withInput();
            }

            $this->data['class_id']     = $classId;
            $this->data['exam_id']      = $examId;
            $this->data['section_id']   = $request['section_id'];
            $this->data['subject_id']   = $request['subject_id'];
            $this->data['rules']        = $rules;
            $this->data['students']     = $students;
            $this->data['objData']      = $this->getMarks($request);
        }

        $this->layout('create');
    }




    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $this->indexValidation($request);
        $markData = $this->getMarkWhere($request);
        $markId = ExamMark::updateOrCreate($markData, $markData)->id;
        $students   = $request['students'];
        if (!empty($students)){
            foreach ($students as $key=>$value){
                if (!empty($value)) {
                    $matchThese = [
                        'subject_id'        => $request['subject_id'],
                        'exam_mark_id'      => $markId,
                        'student_id'        => $value,
                    ];
                    $data = $matchThese;
                    $data['section_id']     = $request['section_id'];
                    $data['rules_marks']    = json_encode($request['marks'][$key]);
                    $data['comment']        = $request['comment'][$key];
                    $this->model::updateOrCreate($matchThese, $data);
                }
            }
            return redirect($this->bUrl)->with('success', successMessage('', $this->title));
        }else{
            return redirect()->back()->withErrors('In this class, student are not found.')->withInput();
        }

    }



    public function getSectionsSubjects(Request $request){
        if (!$request->ajax()){
            return response("Bad Request!", 422);
        }
        $classId = $request['class_id'];
        $classId = filter_var($classId, FILTER_VALIDATE_INT);
        if($classId){
            $sections = Section::where('class_id', $classId)->orderBy('order_by')->get();
            $subjects = Subject::where('class_id', $classId)->orderBy('order_by')->get();
            $data = [
                'sections'=> $sections,
                'subjects'=> $subjects,
            ];
            return response(json_encode($data), 200);
        }

    }

}
