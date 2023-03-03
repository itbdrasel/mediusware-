<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;

use Modules\Scms\Models\ClassCategory;
use Modules\Scms\Models\ClassGroupRules;
use Modules\Scms\Models\Exam;
use Modules\Scms\Models\ExamRule;
use Modules\Scms\Models\RuleManage;
use Validator;

class RulesManageController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->model            = ClassGroupRules::class;
        $this->bUrl             = $this->moduleName.'/rules-manage';
        $this->title            = 'Rules Manage';
    }


    public function layout($pageName){
        echo $this->getLayout('rules_manage',$pageName);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $this->data                 = $this->crudServices->getIndexData($request, $this->model, 'id', ['ruleManages', 'ruleManages.ruleName','classGroup','exam'], $this->getWhere());
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
    public function create(){
        $this->data                     = $this->createEdit();
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

        $this->data             = $this->createEdit($id);
        $this->data['objData']  = $objData;


        $this->layout('create');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $this->getValidation($request);
        $id = $request[$this->tableId];
        $params = $this->crudServices->getInsertData($this->model, $request);
        $params['branch_id']    = getBranchId();
        $params['vtype']        = getVersionType();
        $ruleId                 = $request['rule_id'];
        if (empty($id) ) {
           $class_group_rule_id = $this->model::create($params)->id;
        }else{
            $class_group_rule_id = $id;
            $this->model::where($this->tableId, $id)->update($params);
            RuleManage::where('class_group_rule_id', $id)->update(['status'=>8]);
        }

        if (!empty($ruleId)) {
            foreach ($ruleId as $key => $value) {
                $ruleData = [
                    'rule_id'              => $value,
                    'class_group_rule_id'   => $class_group_rule_id,
                    'status'                => 1,
                ];
               $group   = RuleManage::where(['class_group_rule_id'=>$id, 'rule_id'=>$value])->first();
                if (!empty($group)){
                    RuleManage::where(['class_group_rule_id' =>$id, 'rule_id' =>$value])->update($ruleData);
                }else{
                    RuleManage::create($ruleData);
                }
            }
        }

        if (!empty($id)) {
            RuleManage::where(['class_group_rule_id'=>$id, 'status'=>8])->delete();
        }

        return redirect($this->bUrl)->with('success', successMessage($id, $this->title));

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
            RuleManage::where('class_group_rule_id', $id)->delete();
            return true;
        }
        return false;

    }

    public function getValidation($request){
        $validationRules    = $this->crudServices->getValidationRules($this->model);
        $rules              = $validationRules['rules'];
        $attribute          = $validationRules['attribute'];
        $customMessages     = [];
        return $request->validate($rules,$customMessages, $attribute);
    }


    public function createEdit($id=''){
        $where                          = $this->getWhere();
        $this->data                     = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $this->data['class_groups']     = ClassCategory::where($where)->get();
        $this->data['exams']            = Exam::where($where)->orderBy('order_by')->get();
        $this->data['exam_rules']       = ExamRule::where($where)->orderBy('order_by')->get();
        return $this->data;
    }

    public function getWhere(){
        return ['vtype'=>getVersionType(), 'branch_id'=>getBranchId()];
    }

}
