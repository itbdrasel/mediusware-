<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Models\Subject;
use Modules\Scms\Services\Backend\SubjectService;
use Validator;

class SubjectController extends Controller
{

    private $services;

    public function __construct(SubjectService $subjectService){
        parent::__construct();
        $this->services         = $subjectService;
        $this->model            = Subject::class;
        $this->bUrl             = $this->moduleName.'/subject';
        $this->pUrl             = $this->bUrl.params();
        $this->title            = 'Subject';
    }


    public function layout($pageName){
        echo $this->getLayout('subject',$pageName);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $class_id=''){
        $this->data     = $this->services->getIndexData($request, $class_id);
        $this->data['sidebar_collapse'] = 'sidebar-collapse sidebar-mini';

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
        $params['branch_id']    = getBranchId();
        $params['vtype']        = getVersionType();
        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->pUrl)->with('success', successMessage($id, $this->title));
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            return redirect($this->pUrl)->with('success', successMessage($id, $this->title));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->model::where($this->tableId, $id)->delete();
            return true;
        }
        return false;

    }

    public function getWhere(){
        return ['vtype'=>getVersionType(), 'branch_id'=>getBranchId()];
    }

}
