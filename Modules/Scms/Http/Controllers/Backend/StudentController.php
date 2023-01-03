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
        $this->data                     = $this->studentServices->getIndexData($request, $class_id, $section_id);
        $this->data['sidebar_collapse'] = 'sidebar-collapse sidebar-mini';
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(Request $request){
        $this->data                 = $this->studentServices->createEdit($request['class']);
        $this->data['section_id']   = $request['section'];
        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id){

        $objData = $this->studentServices->editObjData($id);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data = $this->studentServices->createEdit($objData->class_id, $id);
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
        $message = empty($id)?'Record Successfully Created.':'Successfully Updated';
        return redirect($this->bUrl.'/'.$request['class_id'])->with('success', $message);

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
