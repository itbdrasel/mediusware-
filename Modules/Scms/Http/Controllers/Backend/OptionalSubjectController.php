<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Entities\Enroll;
use Modules\Scms\Entities\OptionalSubject;
use Modules\Scms\Entities\Subject;
use Validator;

class OptionalSubjectController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $tableId;
    private $moduleName;
    private $auth;

    public function __construct(Auth $auth){
        $this->auth             = $auth;
        $this->model            = OptionalSubject::class;
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/optional-subject';
        $this->title            = 'Optional Subject';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::backend.optional_subject.'.$pageName.'', $this->data);

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
            'allData'           => [],
            'optionalSubject'   =>[],
            'fourSubject'       =>[]
        ];
        $this->data['allClass'] = getClass();

        if($request->method() === 'POST' ){
            // Validation
            $rules = [
                'class_id'	=> ['required'],
            ];
            $attribute =[
                'class_id'=>'class'
            ];
            $customMessages  =[];
            $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $this->data['allData']          =  $this->getStudentData($request);
                $this->data['optionalSubject']  =  Subject::where(['class_id'=>$class_id, 'status'=>1, 'subject_type'=>4])->orderBy('order_by')->get();
                $this->data['fourSubject']      =  Subject::where(['class_id'=>$class_id, 'status'=>1, 'subject_type'=>3])->orderBy('order_by')->get();
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
        $students   = $request['student_id'];
        $ob_sub     = $request['ob_sub'];
        $four_sub   = $request['four_sub'];
        $class_id   = $request['class_id'];
        if (!empty($students) && !empty($class_id)){
            foreach ($students as $key=>$student){
                if (!empty($student)){
                    $optionalSubData = [
                        'class_id'      => $class_id,
                        'student_id'    => $student,
                        'o_subjects'    => json_encode($ob_sub[$student]??NULL),
                        'four_subject'  => $four_sub[$student]??NULL,
                    ];
                   $optionalSub = OptionalSubject::where(['student_id'=>$student, 'class_id'=>$class_id])->first();
                   if (!empty($optionalSub)){
                       $optionalSub->update($optionalSubData);
                   }else{
                       OptionalSubject::create($optionalSubData);
                   }
                }
            }
        }

        return redirect($this->bUrl)->with('success', 'Record Successfully.');

    }

    public function getStudentData($request){
       $class_id    = $request['class_id'];
       $section_id  = $request['section_id'];

       $queryData   = [];
       if (!empty($class_id)){
           $enroll      = 'scms_enroll.';
           $student     = 'scms_student';
           $where= ['class_id'=>$class_id, 'year'=>getRunningYear(), 'vtype'=>getVersionType()];
           if (!empty($section_id)) {
               $where['section_id'] = $section_id;
           }
           $queryData   = Enroll::leftJoin($student, $enroll.'.student_id', '=', $student.'.id')
               ->where($where)
               ->select($student.'.id','name', 'id_number','roll')->get();
       }
       return $queryData;
    }

}
