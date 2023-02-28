<?php


namespace Modules\Scms\Services\Backend;

use Modules\Core\Models\Gender;
use Modules\Core\Models\Religion;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Models\Group;
use Modules\Scms\Models\Subject;
use Modules\Scms\Models\SubjectType;
use Validator;

class SubjectService
{

    private $model;
    private $title;
    private $moduleName;
    private $bUrl;
    private $tableId;
    public function __construct(CRUDServices $crudServices){
        $this->model            = Subject::class;
        $this->title            = 'Subject';
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/subject';
        $this->crudServices     = $crudServices;
    }

    public function getIndexData( $request, $class_id=''){

        $where = '';
        $class = getClass();
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }
        if (!empty($class_id)){
            $where = ['class_id'=>$class_id];
        }
        $indexData              = $this->crudServices->indexQuery($request, $this->model, 'order_by', ['teacher','subjectType'], $where);
        $queryData              = $indexData['query'];
        $data                   = $indexData['data'];
        $data['allClass']       = $class;
        $data['class_id']       = $class_id;
        $data['teachers']       = getTeacher();
        $data['title']          = $this->title.' Manager';
        $data['pageUrl']        = $this->bUrl;
        $data['page_icon']      = '<i class="fas fa-tasks"></i>';

        $perPage                = $this->crudServices->getPerPage($request);
        $data['serial']         = ( ($request->get('page') ?? 1) -1) * $perPage;
        $data['allData']        =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        return $data;

    }

    public function createEdit($class_id, $id=''){
        $this->data                     = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $this->data['teachers']         = getTeacher();
        $this->data['class_id']         = $class_id;
        $this->data['allClass']         = getClass(['id'=>$class_id]);
        $this->data['subject_types']    = SubjectType::get();
        $this->data['religions']        = Religion::orderBy('order_by')->get();
        $this->data['groups']           = Group::orderBy('order_by')->get();
        $this->data['genders']          = Gender::orderBy('order_by')->get();
        $this->data['relative_subjects']= $this->model::whereNull('subject_parent_id')->where('class_id', $class_id)->orderBy('order_by')->get();
        return $this->data;
    }
    public function getValidationRules($request){
        $validationRules = $this->crudServices->getValidationRules($this->model);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }
}
