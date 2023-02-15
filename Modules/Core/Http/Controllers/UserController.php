<?php
namespace Modules\Core\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Entities\Branch;
use Modules\Core\Entities\Module;
use Modules\Core\Entities\ModuleSection;
use Modules\Core\Entities\Roles;
use Modules\Core\Entities\RoleUser;
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
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/user';
        $this->title            = 'User';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        $this->data['view_path']    =  $this->moduleName.'::pages.user.';

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
        ];
        $role = $this->auth->getUser()->roles->first();

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
    public function create(){

        $this->data                 = $this->crudServices->createEdit($this->title, $this->bUrl);

        $role                       = $this->auth->getUser()->roles->first();
        $order_by                   = $role->order_by;
        $this->data['roles']        = Roles::where('order_by','>=',$order_by)->orderBY('order_by')->get();
        $this->data['allBranch']    = Branch::orderBY('order_by')->get();

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

        $this->data  = $this->crudServices->createEdit($this->title, $this->bUrl,$id);
        $this->data['objData'] = $objData;

        $role                       = $this->auth->getUser()->roles->first();
        $order_by                   = $role->order_by;
        $this->data['roles']        = Roles::where('order_by','>=',$order_by)->orderBY('order_by')->get();
        $this->data['allBranch']    = Branch::orderBY('order_by')->get();

        $this->layout('edit');
    }

    public function update(Request $request){
        $id = $request['id'];

        if( !$this->auth->userExist($id) ) abort('404');

        $rules = [
            'full_name'     => 'required',
            'email'         => 'required|email|unique:users,email,'.$id,
            'user_name'     => 'nullable|unique:users,user_name,'.$id,
            'phone'         => 'nullable|unique:users,phone,'.$id,
            'role'          => 'required|integer',
            'status'        => 'required|gt:-1|lt:2'
        ];

        $attribute = [
            'full_name' => 'Full Name',
            'role'      => 'User Role',
            'status'    => 'User Status',
            'phone'     => 'Phone Number',
            'user_name' => 'User Name',
            'branch_id' => 'Branch',
        ];

        if (!empty($request['role'])) {
            $role = $this->auth->findRoleByID($request['role']);
            if ($role->active_branch ==1) {
                $rules['branch_id'] = 'required';
            }
        }
        $customMessages = [];
        $request->validate($rules,$customMessages, $attribute);


        $params = [
            'full_name'             => $request['full_name'],
            'email'                 => $request['email'],
            'user_name'             => $request['user_name'] ?: NULL,
            'phone'                 => $request['phone'] ?: NULL,
            'branch_id'             => $request['branch_id'],
        ];

        RoleUser::where('user_id', $id)->update([ 'role_id' => $request['role'] ]);

        $user = $this->auth->findById($id);
        $this->auth->update($user, $params);

        $this->auth->activateDeactivate($id, $request['status']);

        return 'success';
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $rules = [
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users',
            'user_name'     => 'nullable|unique:users',
            'phone'         => 'nullable|unique:users',
            'password'      => 'required|confirmed|min:6',
            'role'          => 'required|integer',

        ];

        $attribute = [
            'full_name' => 'Full Name',
            'role'      => 'User Role',
            'status'    => 'User Status',
            'phone'     => 'Phone Number',
            'user_name' => 'User Name',
            'branch_id' => 'Branch',
        ];
        if (!empty($request['role'])) {
            $role = $this->auth->findRoleByID($request['role']);
            if ($role->active_branch ==1) {
                $rules['branch_id'] = 'required';
            }
        }


        $customMessages =[];

        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $registerData = [
            'full_name'             => $request['full_name'],
            'email'                 => $request['email'],
            'user_name'             => $request['user_name'] ?: NULL,
            'phone'                 => $request['phone'] ?: NULL,
            'password'              => $request['password'],
            'role'                  => $request['role'],
            'branch_id'             => $request['branch_id'],
        ];


       $this->auth->register($registerData);

        return redirect($this->bUrl)->with('success', 'Record Successfully Created.');

    }




    public function profile($id){

        $objData    = $this->model::where('users.id', $id)
            ->leftJoin('role_users', 'users.id', 'role_users.user_id')
            ->leftJoin('roles', 'role_users.role_id', 'roles.id')
            ->selectRaw('users.*, roles.name, roles.id as role_id')->first();

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data = [
            'title'         =>  $this->title.' Profile',
            'page_icon'     => '<i class="fa fa-book"></i>',
            'objData'       => $objData,
            'pageUrl'       => $this->bUrl.'/'.$id,
        ];
        $this->layout('profile');
    }

    public function permission($id){

        $objData    = $this->model::where('users.id', $id)
            ->leftJoin('role_users', 'users.id', 'role_users.user_id')
            ->leftJoin('roles', 'role_users.role_id', 'roles.id')
            ->selectRaw('users.*, roles.name, roles.id as role_id')->first();

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data = [
            'title'         =>  $this->title.' Profile',
            'page_icon'     => '<i class="fa fa-book"></i>',
            'objData'       => $objData,
            'pageUrl'       => $this->bUrl.'/'.$id,
        ];
        $this->data['modules']      = Module::orderBy('id')->with('sections')->where('status',1)->get();
        $this->layout('permission');
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
