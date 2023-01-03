<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Entities\Gender;
use Modules\Core\Entities\Religion;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Entities\Group;
use Modules\Scms\Entities\Student;
use Modules\Scms\Entities\Subject;
use Modules\Scms\Entities\SubjectType;
use Modules\Scms\Services\StudentService;
use Modules\Scms\Services\SubjectService;
use Validator;

class SubjectController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $tableId;
    private $moduleName;
    private $services;
    private $auth;

    public function __construct(Auth $auth, SubjectService $subjectService){
        $this->auth             = $auth;
        $this->services         = $subjectService;
        $this->model            = Subject::class;
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/subject';
        $this->title            = 'Subject';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::backend.subject.'.$pageName.'', $this->data);

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $class_id=''){
        $this->data     = $this->services->getIndexData($request, $class_id);
        $this->data['sidebar_collapse'] = 'sidebar-collapse sidebar-mini';
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(Request $request){
        if (empty($request['class'])){
            return redirect($this->bUrl)->with('error', 'please add class.');
        }
        $this->data             = $this->services->createEdit($request['class']);
        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id){
        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data                 = $this->services->createEdit($objData->class_id, $id);
        $this->data['objData']      = $objData;
        $this->layout('create');
    }


    public function show(CRUDServices $CRUDServices,$id){
        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data             = $CRUDServices->show($this->title, $this->bUrl.'show',$id);
        $this->data ['objData'] = $objData;
        $this->layout('view');
    }



    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(CRUDServices $CRUDServices, Request $request){
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if($request->method() === 'POST' ){
            $this->model::where($this->tableId, $id)->delete();
            echo json_encode(['fail' => FALSE, 'error_messages' => "was deleted."]);
        }else{
            return $this->crudServices->destroy($id, $this->model, $this->tableId, $this->bUrl, $this->title);
        }

    }

}
