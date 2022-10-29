<?php
namespace Modules\Hrms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Entities\Roles;
use Modules\Hrms\Entities\Department;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Validator;

class DepartmentController extends Controller
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
        $this->model            = Department::class;
        $this->tableId          = 'id';
        $this->bUrl             = $this->moduleName.'/department';
        $this->title            = 'Department';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::department.'.$pageName.'', $this->data);

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

        $all_data = $this->crudServices->getIndexData($request, $this->model, $this->tableId);

        if ($request->filled('filter')) {
            $this->data['filter'] = $filter = $request->get('filter');
        }
        $this->data['allData']  = $all_data['allData']; // paginate
        $this->data['serial']   = $all_data['serial'];

        $role                       = $this->auth->getUser()->roles->first();
        $order_by                   = $role->order_by;
        $this->data['roles']        = Roles::where('order_by','>=',$order_by)->orderBY('order_by')->get();

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

        $role                       = $this->auth->getUser()->roles->first();
        $order_by                   = $role->order_by;
        $this->data['roles']        = Roles::where('order_by','>=',$order_by)->orderBY('order_by')->get();
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
//            return redirect($this->bUrl)->with('success', 'Successfully Updated');
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

    public function getValidation($request){
        $validationRules = $this->crudServices->getValidationRules($this->model);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }

    public function getInsertData($request){
        return $this->crudServices->getInsertData($this->model, $request);
    }




}