<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Entities\Student;
use Modules\Scms\Services\StudentService;
use Validator;

class StudentController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $tableId;
    private $moduleName;
    private $studentServices;
    private $auth;

    public function __construct(Auth $auth, StudentService $studentService){
        $this->auth             = $auth;
        $this->studentServices  = $studentService;
        $this->model            = Student::class;
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/student';
        $this->title            = 'Student';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::backend.student.'.$pageName.'', $this->data);

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $class_id='', $section_id=''){
        $this->data                 = $this->studentServices->getIndexData($request, $class_id, $section_id);
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(){
        $this->data = $this->studentServices->createEdit();
        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id){

        $objData = $this->model::where('scms_student.id', $id)
            ->select('scms_student.*',
                'scms_enroll.id as enroll_id','scms_enroll.class_id', 'scms_enroll.section_id',  // Enroll Select
                'scms_enroll.roll as class_roll','scms_enroll.group_id', 'scms_enroll.shift as shift_id',
                'scms_parent.father_name','scms_parent.father_contact','scms_parent.father_profession', // Parent Select
                'scms_parent.mother_name','scms_parent.mother_contact','scms_parent.mother_profession',
                'scms_parent.name as guardian_name','scms_parent.phone as guardian_phone',
                'scms_parent.email as guardian_email', 'scms_parent.profession as guardian_profession'
            )
            ->rightJoin('scms_enroll','scms_student.id', 'scms_enroll.student_id')
            ->leftJoin('scms_parent','scms_student.parent_id', 'scms_parent.id')
            ->where(['scms_enroll.year'=>getRunningYear(), 'scms_enroll.vtype'=>getVersionType()])
            ->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data = $this->studentServices->createEdit($id);
        $this->data['objData']= $objData;

        $this->layout('create');
    }

    public function show($id){

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }

        $this->data = [
            'title'         => $this->title.' Information',
            'pageUrl'       => $this->bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-eye"></i>',
            'objData'       => $objData
        ];

        $this->layout('view');
    }



    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $id = $request[$this->tableId];
        $validator =  $this->studentServices->getValidationRules($request);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->studentServices->insertData($request);
        if (empty($id) ) {
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            return redirect($this->bUrl)->with('success', 'Successfully Updated');
        }

    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,crudServices $CRUDServices, $id)
    {
        if($request->method() === 'POST' ){
            $this->model::where($this->tableId, $id)->delete();
            echo json_encode(['fail' => FALSE, 'error_messages' => "was deleted."]);
        }else{
            return $CRUDServices->destroy($id, $this->model, $this->tableId, $this->bUrl, $this->title);
        }

    }
}
