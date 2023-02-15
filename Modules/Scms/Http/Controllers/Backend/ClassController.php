<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Entities\ClassModel;
use Validator;

class ClassController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $auth;
    private $tableId;
    private $moduleName;
    private $crudServices;

    public function __construct(Auth $auth, CRUDServices $crudServices){
        $this->moduleName       = getModuleName(get_called_class());
        $this->auth             = $auth;
        $this->crudServices     = $crudServices;
        $this->model            = ClassModel::class;
        $this->tableId          = 'id';
        $this->bUrl             = $this->moduleName.'/class';
        $this->title            = 'Class';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        $this->data['view_path']    =  $this->moduleName.'::backend.class.';
        echo view( $this->data['view_path'].$pageName.'', $this->data);


    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'objData'       => [],
            'filters'       => $this->model::$filters
        ];
        $this->data['add_title'] = 'Add New '.$this->title;

        $this->data['teachers'] = getTeacher();
        $all_data = $this->crudServices->getIndexData($request, $this->model, 'order_by', 'teacher');


        if ($request->filled('filter')) {
            $this->data['filter'] = $filter = $request->get('filter');
        }
        $this->data['allData']  = $all_data['allData']; // paginate
        $this->data['serial']   = $all_data['serial'];

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
    public function edit($id){

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }

        $this->data = [
            'title'         => 'Edit '.$this->title,
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-edit"></i>',
            'objData'       => $objData
        ];

        $this->data['teachers'] = getTeacher();

        $this->layout('edit');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $id = $request[$this->tableId];
        $validator = $this->getValidation($request);

        if ($validator->fails()){
            if (!empty($id)) {
                return response()->json($validator->messages(), 200);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $this->getInsertData($request);

        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            return 'success';
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

    public function getValidation($request){
        $validationRules = $this->crudServices->getValidationRules($this->model);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return $request->validate($rules,$customMessages, $attribute);
    }

    public function getInsertData($request){
        return $this->crudServices->getInsertData($this->model, $request);
    }




}
