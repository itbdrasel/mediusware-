<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Entities\Enroll;
use Modules\Scms\Entities\OptionalSubject;
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
        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-book"></i>',
            'class_id'      => $request['class_id'],
            'section_id'    => $request['section_id'],
            'allData'       => [],
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

                $this->data['allData'] =  $this->getStudentData($request);
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
        $id = $request[$this->tableId];
        $validator      = $this->services->getValidationRules($request);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $CRUDServices->getInsertData($this->model,$request);

        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->bUrl.'/'.$request['class_id'])->with('success', 'Record Successfully Created.');
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            return redirect($this->bUrl.'/'.$request['class_id'])->with('success', 'Successfully Updated');
        }

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
               ->where($where)->select($student.'.id','name', 'id_number','roll')->get();
       }
       return $queryData;
    }

}
