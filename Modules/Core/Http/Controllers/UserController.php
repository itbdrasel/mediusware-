<?php
namespace Modules\Core\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Validator;

class UserController extends Controller
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
        $this->auth             = $auth;
        $this->crudServices     = $crudServices;
        $this->model            = User::class;
        $this->tableId          = 'id';
        $this->moduleName       = 'core';
        $this->bUrl             = $this->moduleName.'/user';
        $this->title            = 'user';
    }


    public function layout($pageName){

        $this->data['bUrl']     =  $this->bUrl;
        $this->data['tableID']  =  $this->tableId;

        echo view($this->moduleName.'::pages.user.'.$pageName.'', $this->data);

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
        ];

        $all_data = $this->crudServices->getIndexData($request, $this->model, $this->tableId);

        if ($request->filled('filter')) {
            $this->data['filter'] = $filter = $request->get('filter');
        }
        $this->data['allData']  = $all_data['allData']; // paginate
        $this->data['serial']   = $all_data['serial'];

        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(){

        $this->data = [
            'title'         => 'Add New '.$this->title,
            'pageUrl'       => $this->bUrl.'/create',
            'page_icon'     => '<i class="fas fa-plus"></i>',
            'objData'       => ''
        ];

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

        $this->data = [
            'title'         => 'Edit '.$this->title,
            'pageUrl'       => $this->bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-edit"></i>',
            'objData'       => $objData
        ];

        $this->layout('create');
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
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $this->getInsertData($request);

        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            return redirect($this->bUrl)->with('success', 'Successfully Updated');
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
