<?php


namespace Modules\Scms\Traits;


use Modules\Scms\Models\ClassModel;
use Modules\Scms\Models\Exam;
use Modules\Scms\Models\RuleMarkManage;
use Modules\Scms\Models\Subject;

trait RuleMarkd
{
    public function __construct()
    {
        parent::__construct();
        $this->model = RuleMarkManage::class;
        $this->bUrl = $this->moduleName . '/rule-marks';
        $this->title = 'Rule Marks';
    }

    public function getWhere()
    {
        return ['vtype' => getVersionType(), 'branch_id' => getBranchId()];
    }

    public function getValidation($request)
    {
        $validationRules = $this->crudServices->getValidationRules($this->model);

        $rules = $validationRules['rules'];
        $rules['start_year']    = 'nullable|regex:/^\d{4}$/';
        $rules['end_year']      = 'nullable|regex:/^\d{4}$/';
        $rules['exam_id']       = ['required', function ($attribute, $value, $fail) use ($request){
            $unique = $this->uniqueRuleMark($request['class_id'], $request['exam_id'], $request['start_year'], $request['end_year'], $request['id']);
            if (!empty($unique)){
                $fail($unique);
            }
        }];
        $attribute = $validationRules['attribute'];
        $customMessages = [];
        return $request->validate($rules, $customMessages, $attribute);
    }


    public function createEdit($objData, $id = '')
    {
        $where                          = $this->getWhere();
        $this->data                     = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $this->data['allClass']         = ClassModel::where($where)->get();
        $this->data['exams']            = Exam::where($where)->orderBy('order_by')->get();
        $this->data['objData']          = !empty($id)?$objData:'';
        $this->data['class_id']         = $objData->class_id;
        $this->data['exam_id']          = $objData->exam_id;
        $this->data['start_year']       = $objData->start_year;
        $this->data['end_year']         = $objData->end_year;
        $this->data['subjects']         = Subject::where($where)->where(['class_id' => $objData->class_id])->with('ruleMark')->get();

        return $this->data;
    }



    public function uniqueRuleMark($class_id, $exam_id, $start_year = null, $end_year = null, $id = null)
    {
        $ruleMarkQquery = $this->model::where(['class_id'=>$class_id, 'exam_id'=>$exam_id]);
        if ($start_year && $end_year){
            $ruleMarkQquery->where('start_year', '<=', $end_year)
                ->where('end_year', '>=', $start_year);
        }else{
            if ($start_year){
                $ruleMarkQquery->where(['start_year'=>$start_year]);
            }elseif ($end_year){
                $ruleMarkQquery->where(['end_year'=>$end_year]);
            }
        }
        if ($id){
            $ruleMarkQquery->whereNotIn('id', [$id]);
        }
        $ruleMark = $ruleMarkQquery->first();

        return !empty($ruleMark)?'The rule marks has already been taken.':'';
    }
}
