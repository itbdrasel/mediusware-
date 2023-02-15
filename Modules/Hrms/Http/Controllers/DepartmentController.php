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
        $this->data['view_path']    =  $this->moduleName.'::department.';

        echo view( $this->data['view_path'].$pageName.'', $this->data);


    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){

        $this->data                 = $this->crudServices->getIndexData($request, $this->model, 'order_by');
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
        $this->data['add_title']    = 'Add New '.$this->title;
        if ($request->ajax() || $request['ajax']){
            return $this->layout('data');
        }

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

        $this->data  = $this->crudServices->createEdit($this->title, $this->bUrl,$id);
        $this->data['objData'] = $objData;
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
        $params = $this->crudServices->getInsertData($this->model, $request);
        if (empty($id) ) {
            $validator = $this->getValidation($request);
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $this->model::create($params);
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            $this->getValidation($request);
            $this->model::where($this->tableId, $id)->update($params);
            return 'Successfully Updated';
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

}
