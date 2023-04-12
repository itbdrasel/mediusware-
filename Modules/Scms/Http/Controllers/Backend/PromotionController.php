<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\ExamMark;
use Modules\Scms\Models\Section;
use Modules\Scms\Services\Backend\Controller;

use Illuminate\Http\Request;



use Validator;

class PromotionController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->bUrl             = $this->moduleName.'/promotion ';
        $this->title            = 'Promotion ';
    }

    public function layout($pageName){
        echo $this->getLayout('promotion',$pageName);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(Request $request){

        $this->data = [
            "title"         => "Student {$this->title}",
            "pageUrl"       => $this->bUrl,
            "page_icon"     => "<i class='fas fa-tasks'></i>",
            "allClass"      => getClass(),
            "objData"       => ""
        ];

        if ($request['_method'] === "POST") {
            $this->createValidation($request);
            $classId = $request["class_id"];
            $examId = $request["exam_id"];

            // promote student check
            $promotestudents    = $this->getPromoteStudentCheck($request);
            if ($promotestudents){
                return redirect()->back()->withErrors("In this promotion class, students have already been promoted.")->withInput();
            }
            // student check
            $students           = $this->getStudents($request);
            if ($students->isEmpty()){
                return redirect()->back()->withErrors("In this class, student are not found.")->withInput();
            }

            $this->data['class_id']     = $request["class_id"];
            $this->data['section_id']   = $request['section_id'];
            $this->data['section_id']   = $request['section_id'];
            $this->data['p_year']       = $request['p_year'];
            $this->data['p_class_id']   = $request['p_class_id'];
            $this->data['p_section_id'] = $request['p_section_id'];
            $this->data['students']     = $students;
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
            $data = [
                'sections'=> $sections,
            ];
            return response(json_encode($data), 200);
        }

    }

}
