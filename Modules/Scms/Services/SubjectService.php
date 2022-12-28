<?php


namespace Modules\Scms\Services;

use Modules\Core\Entities\Religion;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Entities\Group;
use Modules\Scms\Entities\Subject;
use Modules\Scms\Entities\SubjectType;
use Validator;

class SubjectService
{

    private $model;
    private $title;
    private $moduleName;
    private $bUrl;
    private $tableId;
    public function __construct(){
        $this->model            = Subject::class;
        $this->title            = 'Subject';
        $this->tableId          = 'id';
        $this->moduleName       = getModuleName(get_called_class());
        $this->bUrl             = $this->moduleName.'/subject';
    }

    public function getIndexData(CRUDServices $CRUDServices, $request, $class_id=''){

        $where = '';
        $class = getClass();
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }
        if (!empty($class_id)){
            $where = ['class_id'=>$class_id];
        }
        $indexData              = $CRUDServices->indexQuery($request, $this->model, $this->tableId, 'teacher', $where);
        $queryData              = $indexData['query'];
        $data                   = $indexData['data'];
        $data['allClass']       = $class;
        $data['class_id']       = $class_id;
        $data['teachers']       = getTeacher();
        $data['title']          = $this->title.' Manager';
        $data['pageUrl']        = $this->bUrl;
        $data['page_icon']      = '<i class="fas fa-tasks"></i>';

        $perPage = $CRUDServices->getPerPage($request);

        $data['allData']        =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        return $data;

    }

    public function createEdit(CRUDServices $CRUDServices, $id=''){
        $this->data                     = $CRUDServices->createEdit($this->title, $this->bUrl,$this->model, $id);
        $this->data['teachers']         = getTeacher();
        $this->data['allClass']         = getClass();
        $this->data['subject_types']    = SubjectType::get();
        $this->data['religions']        = Religion::orderBy('order_by')->get();
        $this->data['groups']           = Group::orderBy('order_by')->get();
        $this->data['relative_subjects']= $this->model::whereNull('subject_parent_id')->orderBy('order_by')->get();
        return $this->data;

    }
    public function getValidationRules(CRUDServices $CRUDServices, $request){
        $validationRules = $CRUDServices->getValidationRules($this->model);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }
}
