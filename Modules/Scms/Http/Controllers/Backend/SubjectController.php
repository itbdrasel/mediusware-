<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Entities\Student;
use Modules\Scms\Entities\Subject;
use Modules\Scms\Services\StudentService;
use Validator;

class SubjectController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $tableId;
    private $moduleName;
    private $crudServices;
    private $auth;

    public function __construct(Auth $auth, CRUDServices $crudServices){
        $this->auth             = $auth;
        $this->crudServices    = $crudServices;
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
        $where = '';
        $class = getClass();
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }
        if (!empty($class_id)){
            $where = ['class_id'=>$class_id];
        }
        $this->data                 = $this->crudServices->getIndexData($request, $this->model, $this->tableId,'teacher', $where);
        $data['allClass']           = $class;
        $data['teachers']           = getTeacher();
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
        $this->data['page_icon']    = '<i class="fas fa-tasks"></i>';
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(){
        $this->data         = $this->crudServices->createEdit($this->title, $this->bUrl);
        $data['teachers']   = getTeacher();
        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id){
        $this->data         = $this->crudServices->createEdit($this->title, $this->bUrl,$this->model, $id);
        $data['teachers']   = getTeacher();
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
        $validator =  $this->crudServices->getValidationRules($this->model);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $this->crudServices->getInsertData($this->model,$request);

        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            $this->model::where($this->tableId, $id)->update($params);

            return redirect($this->bUrl)->with('success', 'Successfully Updated');
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
            return $this->crudServices->destroy($request, $id, $this->model, $this->tableId, $this->bUrl, $this->title);
        }

    }
}
