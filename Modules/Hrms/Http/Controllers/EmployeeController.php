<?php
namespace Modules\Hrms\Http\Controllers;


use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Modules\Core\Entities\BloodGroup;
use Modules\Core\Entities\Gender;
use Modules\Core\Entities\Religion;
use Modules\Core\Repositories\AuthInterface as Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Hrms\Entities\Department;
use Modules\Hrms\Entities\Designation;
use Modules\Hrms\Entities\Employee;
use Validator;

class EmployeeController extends Controller
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
        $this->model            = Employee::class;
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/employee';
        $this->title            = 'Employee';
    }


    public function layout($pageName){
        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;
        $this->data['view_path']    =  $this->moduleName.'::employee.';

        echo view( $this->data['view_path'].$pageName.'', $this->data);

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){


        $this->data                 = $this->crudServices->getIndexData($request, $this->model, $this->tableId, ['department','designation']);
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
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

        $this->data                 = $this->crudServices->createEdit($this->title, $this->bUrl);

        $this->data['genders']      = Gender::orderBy('order_by')->orderBy('id')->get();
        $this->data['religions']    = Religion::orderBy('order_by')->orderBy('id')->get();
        $this->data['blood_groups'] = BloodGroup::orderBy('order_by')->orderBy('id')->get();
        $this->data['departments']  = Department::orderBy('order_by')->orderBy('id')->get();
        $this->data['designation']  = Designation::orderBy('order_by')->orderBy('id')->get();


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

        $this->data['objData']      = $objData;
        $this->data['genders']      = Gender::orderBy('order_by')->orderBy('id')->get();
        $this->data['religions']    = Religion::orderBy('order_by')->orderBy('id')->get();
        $this->data['blood_groups'] = BloodGroup::orderBy('order_by')->orderBy('id')->get();
        $this->data['departments']  = Department::orderBy('order_by')->orderBy('id')->get();
        $this->data['designation']  = Designation::orderBy('order_by')->orderBy('id')->get();

        $this->layout('create');
    }

    public function show($id){

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }

        $this->data = [
            'title'         => $this->title.' Information',
            'pageUrl'       => $this->bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-edit"></i>',
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
        $validator = $this->getValidation($request, $id);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $this->getInsertData($request);
        if (empty($id) ) {
            $employee_id = $this->model::create($params)->id;
            $this->createUser($request, $employee_id);
            return redirect($this->bUrl)->with('success', 'Record Successfully Created.');
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            $this->createUser($request, $id);
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
        if ($request->ajax()) {
            $this->model::where($this->tableId, $id)->delete();
            return true;
        }
        return false;

    }

    public function getValidation($request, $id=''){
        $rules = [
            'id_number'=>'required|unique:hrms_employees,id_number,'.$id,
        ];
        $validationRules = $this->crudServices->getValidationRules($this->model, $rules);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }

    public function getInsertData($request){
        $params = $this->crudServices->getInsertData($this->model, $request);
        $media_name = $request['media_name'];
        $social = [];
        if (!empty($media_name)) {
            foreach ($media_name as $key=>$value){
                if (!empty($value)) {
                    $social[]=  [
                        'media_name'=>$value,
                        'media_link'=>$request['media_link'][$key],
                    ];
                }
            }
        }
        $params['social_media']     =  json_encode($social);
        $params['birth_date']       =  dbDateFormat($request['birth_date']);
        $params['joining_date']     =  dbDateFormat($request['joining_date']);

        return $params;
    }

    public function createUser($request, $id){
        $department_id = $request['department_id'];
        $department = Department::where(['id'=>$department_id])->first();
        if (!empty($department)){
            if (!empty($department->role_id)){
                $user = User::where('employee_id', $id)->first();
                if (empty($user)){
                    $rules = ['email'=>'required|email|unique:users'];
                    $attribute =[];
                    $customMessages =[];
                    $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
                    if ($validator->fails()){
                        return redirect($this->bUrl.'/'.$id.'/edit')->withErrors($validator)->withInput();
                    }
                    $registerData = [
                        'full_name'             => $request['name'],
                        'email'                 => $request['email'],
                        'phone'                 => $request['mobile'] ?: NULL,
                        'password'              =>'12346',
                        'role'                  => $department->role_id,
                        'employee_id'           => $id
                    ];
                    $this->auth->register($registerData);
                }

            }else{
                User::where(['employee_id', $department_id])->delete();
            }
        }

    }




}
