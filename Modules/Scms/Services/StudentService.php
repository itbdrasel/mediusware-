<?php


namespace Modules\Scms\Services;


use Modules\Core\Entities\BloodGroup;
use Modules\Core\Entities\Gender;
use Modules\Core\Entities\Religion;
use Modules\Scms\Entities\Enroll;
use Modules\Scms\Entities\Group;
use Modules\Scms\Entities\ParentModel;
use Modules\Scms\Entities\Section;
use Modules\Scms\Entities\Shift;
use Modules\Scms\Entities\Student;
use Validator;

class StudentService
{

    private $model;
    private $title;
    private $moduleName;
    private $bUrl;
    private $tableId;
    public function __construct(){
        $this->model            = Student::class;
        $this->title            = 'Student';
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/student';
    }

    public function getIndexData($request, $class_id='', $section_id=''){
        $data = [
           'title'      => $this->title.' Manager',
           'pageUrl'    => trim($this->bUrl.'/'. $class_id,'/'),
           'page_icon'  => '<i class="fas fa-tasks"></i>',
        ];
        $model_sortable =  $this->model::$sortable;
        $perPage = session('per_page') ?: 10;

        //table item serial starting from 0
        $data['serial'] = ( ($request->get('page') ?? 1) -1) * $perPage;

        if($request->method() === 'POST'){
            session(['per_page' => $request->post('per_page') ]);
        }


        $class = getClass();
        $data['allClass']     = $class;
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }

        //model query...
        $queryData = $this->model::orderBy( getOrder($model_sortable, 'scms_student.id')['by'], getOrder($model_sortable, 'scms_student.id')['order'])
        ->select('scms_student.id', 'scms_student.name', 'scms_student.phone', 'scms_student.email', 'scms_student.id_number', 'scms_student.photo')
        ->rightJoin('scms_enroll','scms_student.id', 'scms_enroll.student_id');

        //filter by text.....
        $data['filter'] ='';
        if( $request->filled('filter') ){
            $section_id ='';
            $filter =  $this->model::$filters;
            if (!empty($filter)) {
                $sl =0;
                foreach ($filter as $key=>$value){
                    $data['filter'] = $filter = $request->get('filter');
                    $sl++;
                    if ($sl ==1) {
                        $queryData->where($value, 'like', '%'.$filter.'%');
                    }else{
                        $queryData->orWhere($value, 'like', '%'.$filter.'%');
                    }
                }
            }

        }

        $queryData->where(['scms_enroll.class_id'=> $class_id, '']);
        if (!empty($section_id)){
            $queryData->where('scms_enroll.section_id', $section_id);
        }
        $data['class_id']       = $class_id;
        $data['section_id']     = $section_id;
        $data['allData']        =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        $data['sections']       = Section::orderBy('order_by')->where('class_id',  $data['class_id'])->get();
        return $data;

    }

    public function createEdit($id=''){
        if (!empty($id)){
            $this->data = [
                'title'         => 'Edit '.$this->title,
                'pageUrl'       => $this->bUrl.'/'.$id,
                'page_icon'     => '<i class="fas fa-edit"></i>',
            ];
        }else{
            $this->data = [
                'title'         => 'Add New '.$this->title,
                'pageUrl'       => $this->bUrl.'/create',
                'page_icon'     => '<i class="fas fa-plus"></i>',
                'objData'       => ''
            ];
        }
        $this->data['allClass']     = getClass();
        $this->data['groups']       = Group::orderBy('order_by')->orderBy('id')->get();
        $this->data['shifts']       = Shift::orderBy('order_by')->orderBy('id')->get();
        $this->data['genders']      = Gender::orderBy('order_by')->orderBy('id')->get();
        $this->data['religions']    = Religion::orderBy('order_by')->orderBy('id')->get();
        $this->data['blood_groups'] = BloodGroup::orderBy('order_by')->orderBy('id')->get();
        return $this->data;

    }
    public function getValidationRules($request){
        $id = $request['id'];
        $rules = [
            'name'              =>'required',
            'phone'             =>'required|unique:scms_student,phone,'.$id,
            'gender_id'         =>'required',
            'id_number'         =>'required|unique:scms_student,id_number,'.$id,
            'class_id'          =>'required',
            'section_id'        =>'required',
            'group_id'          =>'required',
            'father_name'       =>'required',
            'mother_name'       =>'required',
        ];
        $attribute =[
            'gender_id'          => 'Gender',
            'class_id'           => 'class',
            'section_id'         => 'section',
            'group_id'           => 'group',
        ];
        $customMessages = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }

    public function insertData($request){
        $id = $request[$this->tableId];
        $studentData = $this->getStudentData($request);
        //Guardian Data
        $parentData = $this->getParentData($request);
        //Enroll Data
        $enrollData= $this->getEnrollData($request);
        if (empty($id)){
            $this->insertQueries($parentData, $studentData, $enrollData, $request);
            return true;
        }else{
            Student::where('id',$id)->update($studentData);
            ParentModel::where('id', $request['parent_id'])->update($parentData);
            Enroll::where('id', $request['enroll_id'])->update($parentData);
            return true;
        }
    }
    public function getStudentData($request){
        $array=  $this->model::$insertData;
        $studentData =[];
        for ($i=0; $i<count( $array); $i++){
            if (!empty($request[$array[$i]])){
                $studentData[$array[$i]]= $request[$array[$i]];
            }
        }
        $studentData['birthday'] = dbDateFormat($request['birthday']);
        return $studentData;
    }

    public function getParentData($request){
       return $parentData = [
            'name'              => $request['guardian_name']??'',
            'phone'             => $request['guardian_phone']??'',
            'email'             => $request['guardian_email']??'',
            'address'           => $request['guardian_address']??'',
            'profession'        => $request['guardian_profession']??'',
            'father_name'       => $request['father_name']??'',
            'father_contact'    => $request['father_contact']??'',
            'mother_name'       => $request['mother_name']??'',
            'mother_contact'    => $request['mother_contact']??'',
        ];

    }
    public function getEnrollData($request){
        $id = $request[$this->tableId];
         $enrollData=[
            'class_id'      => $request['class_id'],
            'section_id'    => $request['section_id'],
            'group_id'      => $request['group_id'],
            'shift'         => $request['shift'],
            'roll'          => $request['roll'],
        ];
        if (empty($id)) {
            $enrollData['year'] = getRunningYear();
            $enrollData['vtype'] = getVersionType();
        }
        return $enrollData;
    }

    public function  insertQueries($parentData, $studentData, $enrollData, $request){
        $parent = ParentModel::create($parentData);
        $studentData['parent_id']   = $parent->id;
        $student = Student::create($studentData);
        $enrollData['student_id']   = $student->id;
        Enroll::create($enrollData);
        $this->studentSendSmsEmail($request);
        return true;
    }

    public function studentSendSmsEmail(){

    }



}
