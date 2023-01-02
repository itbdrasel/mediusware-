<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
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
            'objData'       => $this->getStudentData($request),
        ];
        $this->data['allClass'] = getClass();
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
           $queryData = Enroll::leftJoin($student, $enroll.'student_id', '=', $student.'.id')
           ->where([$enroll.'class_id'=>$class_id, $enroll.'year'=>getRunningYear(), $enroll.'vtype'=>getVersionType()])
           ->select($student.'.id', $student.'.name', $student.'.id_number',$enroll.'roll');
           if (!empty($section_id)){
               $queryData->where($enroll.'section_id', $section_id);
           }
           $queryData->get();
       }
       return $queryData;
    }

}
