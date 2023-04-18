<?php


namespace Modules\Scms\Services\Backend;


use Modules\Core\Models\BloodGroup;
use Modules\Core\Models\Gender;
use Modules\Core\Models\Religion;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Models\Enroll;
use Modules\Scms\Models\Group;
use Modules\Scms\Models\ParentModel;
use Modules\Scms\Models\Section;
use Modules\Scms\Models\Shift;
use Modules\Scms\Models\Student;
use Validator;

class StudentService
{

    private $model;
    private $title;
    private $moduleName;
    private $bUrl;
    private $tableId;
    public function __construct(CRUDServices $crudServices){
        $this->model            = Student::class;
        $this->title            = 'Student';
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/student';
        $this->crudServices     = $crudServices;
    }

    public function getIndexData($request, $class_id='', $section_id=''){
        $data = [
           'title'      => $this->title.' Manager',
           'page_icon'  => '<i class="fas fa-tasks"></i>',
        ];
        $model_sortable =  $this->model::$sortable;
        $perPage                = $this->crudServices->getPerPage($request);
        $data['serial']         = ( ($request->get('page') ?? 1) -1) * $perPage;


        $class = getClass();
        $data['allClass']     = $class;
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }
        $branch_id = getBranchId();

        //model query...
        $queryData = $this->model::orderBy( getOrder($model_sortable, 'scms_student.id')['by'], getOrder($model_sortable, 'scms_student.id')['order'])
        ->select('scms_student.id', 'scms_student.name', 'scms_student.phone', 'scms_student.email', 'scms_student.id_number', 'scms_student.photo', 'scms_enroll.roll')
        ->rightJoin('scms_enroll','scms_student.id', 'scms_enroll.student_id')
            ->where('scms_student.branch_id', $branch_id);

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

        $queryData->where(['scms_enroll.class_id'=> $class_id, 'scms_enroll.year'=>getRunningYear(), 'scms_student.vtype'=>getVersionType()]);
        if (!empty($section_id)){
            $queryData->where('scms_enroll.section_id', $section_id);
        }
        $data['pageUrl']        = trim($this->bUrl.'/'. $class_id,'/');
        $data['class_id']       = $class_id;
        $data['section_id']     = $section_id;
        $data['allData']        =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        $data['sections']       = Section::orderBy('order_by')->where('class_id',  $data['class_id'])->get();
        return $data;

    }

    public function createEdit($class_id='', $id=''){

        $data                   = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $data['allClass']       = getClass();
        $data['groups']         = Group::orderBy('order_by')->orderBy('id')->get();
        $data['shifts']         = Shift::orderBy('order_by')->orderBy('id')->get();
        $data['genders']        = Gender::orderBy('order_by')->orderBy('id')->get();
        $data['religions']      = Religion::orderBy('order_by')->orderBy('id')->get();
        $data['blood_groups']   = BloodGroup::orderBy('order_by')->orderBy('id')->get();
        $data['class_id']       = $class_id;
        $data['section_id']     = '';
        return $data;
    }
    public function editObjData($id){
        if (empty($id)) return false;
       return $this->model::where('scms_student.id', $id)
            ->select('scms_student.*',
                'scms_enroll.id as enroll_id','scms_enroll.class_id', 'scms_enroll.section_id',  // Enroll Select
                'scms_enroll.roll as class_roll','scms_enroll.group_id', 'scms_enroll.shift as shift_id',
                'scms_parent.father_name','scms_parent.father_contact','scms_parent.father_profession', // Parent Select
                'scms_parent.mother_name','scms_parent.mother_contact','scms_parent.mother_profession',
                'scms_parent.name as guardian_name','scms_parent.phone as guardian_phone',
                'scms_parent.email as guardian_email', 'scms_parent.profession as guardian_profession'
            )
            ->rightJoin('scms_enroll','scms_student.id', 'scms_enroll.student_id')
            ->leftJoin('scms_parent','scms_student.parent_id', 'scms_parent.id')
            ->where(['scms_enroll.year'=>getRunningYear(), 'scms_student.vtype'=>getVersionType()])
            ->first();
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
            Enroll::where('id', $request['enroll_id'])->update($enrollData);
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
        $studentData['branch_id']   =  getBranchId();;
        $studentData['vtype']       = getVersionType();
        $studentData['birthday']    = dbDateFormat($request['birthday']);
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
            'shift'         => $request['shift_id'],
            'roll'          => $request['class_roll'],
        ];
        if (empty($id)) {
            $enrollData['year'] = getRunningYear();

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
