<?php
namespace Modules\Core\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Entities\Roles;
use Modules\Core\Entities\User;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Validator;
use Sentinel;

class UserController extends Controller
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
        $role = Sentinel::getUser()->roles->first();
        $order_by = $role->order_by;
        $this->data['roles'] = Roles::where('order_by','>=',$order_by)->get();

        $this->data['selected'] = $request['selected'];

        $perPage = session('per_page') ?: 10;


        //table item serial starting from 0
        $this->data['serial'] = ( ($request->get('page') ?? 1) -1) * $perPage;


        if($request->method() === 'POST'){
            session(['per_page' => $request->post('per_page') ]);
        }


        // model query...
        $queryData = $this->model::
        leftJoin('role_users', 'users.id', 'role_users.user_id')
            ->leftJoin('roles', 'role_users.role_id', 'roles.id')
            ->selectRaw('users.*, roles.name')
            ->where('roles.order_by','>=',$order_by)
            // Group by...
            ->orderBy( getOrder($this->model::$sortable, 'users.id')['by'], getOrder($this->model::$sortable, 'users.id')['order'])
        ;

        if( $request->filled('filter') ) {
            $this->data['filter'] = $filter = $request->get('filter');
            $queryData->where(function ($query) use ($filter) {
                $query->orWhere('full_name', 'like', $filter);
                $query->orWhere('email', 'like', $filter);
            });

        }

        //filter by User Role.....
        if( $request->filled('selected') ){
            $this->data['selected'] = $selectedFilter = $request->get('selected');
            $queryData->where( [ 'roles.id' => $selectedFilter ] );
        }

        $this->data['allData'] =  $queryData->paginate($perPage)->appends( request()->query() );

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
