<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Scms\Models\Attendence;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Validator;

class AttendenceController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->model            = Attendence::class;
        $this->bUrl             = $this->moduleName.'/attendence';
        $this->title            = 'Attendence';
    }


    public function layout($pageName){
        echo $this->getLayout('attendence',$pageName);
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $class_id = $request['class_id'];
        $this->data = [
            'title'             => $this->title.' Manager',
            'pageUrl'           => $this->bUrl,
            'page_icon'         => '<i class="fas fa-book"></i>',
            'class_id'          => $class_id,
            'section_id'        => $request['section_id'],
            'date'              => $request['date'],
            'allData'           => [],
        ];
        $this->data['allClass'] = getClass();

        if($request->method() === 'POST' ){
            // Validation
            $rules = [
                'class_id'	    => 'required',
                'section_id'	=> 'required',
                'date'	        => 'required',
            ];
            $attribute =[
                'class_id'      => 'class',
                'section_id'    => 'section'
            ];

            $validator = Validator::make($request->all(), $rules, [], $attribute);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $this->data['allData']          =  $this->getStudentData($request);
            }
        }
        $this->layout('index');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store( Request $request){
        $rules = [
            'class_id'	    => 'required',
            'section_id'	=> 'required',
            'date'	        => 'required',
            'student_id'    => 'required',
            'att_type'      => 'att_type',
        ];
        $attribute =[
            'class_id'      => 'class',
            'section_id'    => 'section',
            'student_id'    => 'student',
            'att_type'      => 'attandance type'
        ];
        $request->validate($rules,[], $attribute);

        $class_id       = $request['class_id'];
        $section_id     = $request['section_id'];
        $date           = $request['date'];
        $students       = $request['student_id'];
        $att_type       = $request['att_type'];
        $note           = $request['note'];
        if (!empty($students) && !empty($class_id)){
            foreach ($students as $key=>$student){
                if (!empty($student)){
                    $matchThese = [
                        'class_id'      => $class_id,
                        'section_id'    => $section_id,
                        'student_id'    => $student,
                        'date'          => $date,
                    ];
                    $data               = $matchThese;
                    $data['att_type']   = $att_type[$key];
                    $data['note']       = $note[$key];
                   $this->model::updateOrCreate($matchThese, $data);
                }
            }
        }

        return redirect($this->bUrl)->with('success', 'Record Successfully.');

    }

    private function getStudentData($request){
       $class_id    = $request['class_id'];
       $section_id  = $request['section_id'];
       $date        = $request['date'];
       $queryData   = [];
       if (!empty($class_id)){
           $where= ['class_id'=>$class_id, 'section_id'=> $section_id];
           $queryData   = $this->model::with('student')
               ->where($where)
               ->orWhere('date',$date)
               ->get();
       }
       return $queryData;
    }

}
