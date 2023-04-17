<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Enroll;
use Modules\Scms\Models\Section;
use Modules\Scms\Services\Backend\Controller;

use Illuminate\Http\Request;

use Modules\Scms\Traits\Promote;
use Validator;

class PromoteController extends Controller
{
    use Promote;


    public function __construct(){
        parent::__construct();
        $this->bUrl             = $this->moduleName.'/promote';
        $this->title            = 'Promote';
    }

    public function layout($pageName){
        echo $this->getLayout('promote',$pageName);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function index(Request $request){

        $this->data = [
            "title"         => "Student {$this->title}",
            "pageUrl"       => $this->bUrl,
            "page_icon"     => "<i class='fas fa-tasks'></i>",
            "allClass"      => getClass(),
            "objData"       => "",
            'promote_year'  => ''
        ];
        if ($request['_method'] === "POST") {
            $this->createValidation($request);

            // student check
            $students           = $this->getStudents($request);
            if ($students->isEmpty()){
                return redirect()->back()->withErrors("In this class, student are not found.")->withInput();
            }

            $this->data['class_id']             = $request['class_id'];
            $this->data['section_id']           = $request['section_id'];
            $this->data['section_id']           = $request['section_id'];
            $this->data['promote_year']         = $request['promote_year'];
            $this->data['promote_class_id']     = $request['promote_class_id'];
            $this->data['promote_section_id']   = $request['promote_section_id'];
            $this->data['students']             = $students;
            $this->data['sections']             = Section::where('class_id', $request['promote_class_id'])->get(['id', 'name']);

        }

        $this->layout('index');
    }




    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $this->getValidation($request);
        $class_id       = $request['promote_class_id'];
        $seciont_id     = $request['promote_section_id'];
        $students       = $request['students'];
        if (!empty($students)){
            foreach ($students as $key=>$value){
                // promote student check
                $promotestudents    = $this->getPromoteStudentCheck($request, $value);
                if (!$promotestudents){
                    if (!empty($value)) {
                        $enrollData = [
                            'student_id'        => $value,
                            'class_id'          => $class_id,
                            'section_id'        => $seciont_id,
                            'group_id'          => $request['group_id'][$key],
                            'shift'             => $request['shift'][$key],
                            'roll'              => $request['roll'][$key],
                            'year'              => $request['promote_year'],
                            'vtype'             => getVersionType(),
                        ];
                        Enroll::create($enrollData);
                    }
                }

            }
            return redirect($this->bUrl)->with('success', successMessage('', $this->title));
        }else{
            return redirect()->back()->withErrors('In this class, student are not found.')->withInput();
        }

    }



    public function getSections(Request $request){
        if (!$request->ajax()){
            return response("Bad Request!", 422);
        }
        $classId = $request['classId'];
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
