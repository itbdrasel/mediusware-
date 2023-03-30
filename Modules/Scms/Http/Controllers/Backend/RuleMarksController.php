<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Illuminate\Validation\Rule;
use Modules\Scms\Models\ClassModel;
use Modules\Scms\Models\RuleMark;
use Modules\Scms\Models\RuleMarkManage;
use Modules\Scms\Models\RulesGroup;
use Modules\Scms\Models\Subject;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;

use Modules\Scms\Models\Exam;
use Validator;

class RuleMarksController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = RuleMarkManage::class;
        $this->bUrl = $this->moduleName . '/rule-marks';
        $this->title = 'Rule Marks';
    }


    public function layout($pageName)
    {
        echo $this->getLayout('rule_marks', $pageName);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->data = $this->crudServices->getIndexData($request, $this->model, 'id', ['className', 'exam', 'ruleMarks', 'ruleMarks.subject'], $this->getWhere());
        $this->data['title'] = $this->title . ' Manager';
        $this->data['pageUrl'] = $this->bUrl;
        if ($request->ajax() || $request['ajax']) {
            return $this->layout('data');
        }
        $this->layout('index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(Request $request)
    {
        $this->data = $this->createEdit();
        if ($request['_method'] === 'POST') {
//        if($request->method() === 'PUT' ){
            $rules = [
                'class_id'  => 'required',
                'exam_id'   =>"required",
                'start_year' => 'nullable|numeric',
                'end_year' => 'nullable|numeric',
               /* 'end_year' => Rule::unique('scms_rule_mark_manage')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request['class_id'])
                        ->where('exam_id', $request['exam_id'])
                        ->where('start_year', $request['start_year'])
                        ->where('end_year', $request['end_year']);
                })*/
            ];


            $attribute = [
                'class_id' => 'The class field is required.',
                'exam_id' => 'The exam field is required.'
            ];
            $customMessages = [
                'unique' => 'The rule marks  has already been taken.'
            ];
            $validator = Validator::make($request->all(), $rules,$customMessages, $attribute);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $class_id = $request['class_id'];
                $exam_id = $request['exam_id'];
                $start_year = $request['start_year'];
                $end_year = $request['end_year'];
                $this->data['class_id'] = $class_id;
                $this->data['exam_id'] = $exam_id;
                $this->data['start_year'] = $start_year;
                $this->data['end_year'] = $end_year;
                $rulesGroup = RulesGroup::where($this->getWhere())->where(['class_id' => $class_id, 'exam_id' => $exam_id])->with('ruleManages');
                if ($start_year && $end_year) {
                    $rulesGroup->where('start_year', '<=', $end_year)
                        ->where('end_year', '>=', $start_year);
                } elseif ($end_year) {
                    $rulesGroup->where('end_year', $end_year);
                } elseif ($end_year) {
                    $rulesGroup->where('start_year', $start_year);
                }
                $rules = $rulesGroup->first();

                $this->data['rules'] = $rules?->ruleManages()->with('ruleName')->get();
                if (empty($this->data['rules'])){
                    return redirect()->back()->withErrors('In this class, exam role are not created.')->withInput();
                }

            $this->data['subjects'] = Subject::where($this->getWhere())->where(['class_id' => $class_id])->get();
                if (empty($this->data['subjects'])){
                    return redirect()->back()->withErrors('In this class, subjects are not created.')->withInput();
                }
            }

        }

        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id || empty($objData)) {
            exit('Bad Request!');
        }

        $this->data = $this->createEdit($id);
        $this->data['objData'] = $objData;


        $class_id = $objData->class_id;
        $exam_id = $objData->exam_id;
        $start_year = $objData->start_year;
        $end_year = $objData->end_year;
        $this->data['class_id'] = $class_id;
        $this->data['exam_id'] = $exam_id;
        $this->data['start_year'] = $start_year;
        $this->data['end_year'] = $end_year;

        $rulesGroup = RulesGroup::where($this->getWhere())->where(['class_id' => $class_id, 'exam_id' => $exam_id])->with('ruleManages');
        if ($start_year && $end_year) {
            $rulesGroup->where('start_year', '<=', $end_year)
                ->where('end_year', '>=', $start_year);
        } elseif ($end_year) {
            $rulesGroup->where('end_year', $end_year);
        } elseif ($end_year) {
            $rulesGroup->where('start_year', $start_year);
        }
        $rules = $rulesGroup->first();

        $this->data['rules'] = $rules?->ruleManages()->with('ruleName')->get();

        $this->data['subjects'] = Subject::where($this->getWhere())->where(['class_id' => $class_id])
            ->with('ruleMark')
            ->get();

        $this->layout('create');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $this->getValidation($request);
        $id = $request[$this->tableId];
        $params = $this->crudServices->getInsertData($this->model, $request);
        $params['branch_id'] = getBranchId();
        $params['vtype'] = getVersionType();

        $subjectId = $request['subject_id'];
        if (empty($id)) {
            $rule_mark_id = $this->model::create($params)->id;
        } else {
            $rule_mark_id = $id;
            $this->model::where($this->tableId, $id)->update($params);
            RuleMark::where('rule_mark_manage_id', $id)->update(['status' => 8]);
        }

        if (!empty($subjectId)) {
            foreach ($subjectId as $key => $value) {
                $ruleData = [
                    'rule_mark_manage_id' => $rule_mark_id,
                    'subject_id' => $value,
                    'full_mark' => $request['full_mark'][$key],
                    'pass_mark' => $request['pass_mark'][$key],
                    'rule_mark' => json_encode($request['marks'][$key]),
                    'status' => 1,
                ];
                $where = ['rule_mark_manage_id' => $rule_mark_id, 'subject_id' => $value];
                RuleMark::updateOrCreate($where, $ruleData);
            }
        }

        if (!empty($id)) {
            RuleMark::where(['rule_mark_manage_id' => $id, 'status' => 8])->delete();
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
            RuleMark::where('rule_mark_manage_id', $id)->delete();
            return true;
        }
        return false;

    }

    public function getValidation($request)
    {
        $validationRules = $this->crudServices->getValidationRules($this->model);

        $rules = $validationRules['rules'];
        $rules['start_year'] = 'nullable|numeric';
        $rules['end_year']  = Rule::unique('scms_rule_mark_manage')->ignore($request['id'])->where(function ($query) use ($request) {
                return $query->where('class_id', $request['class_id'])
                    ->where('exam_id', $request['exam_id'])
                    ->where('start_year', $request['start_year'])
                    ->where('end_year', $request['end_year']);
            });
        $attribute = $validationRules['attribute'];
        $customMessages = [
            'unique' => 'The rule marks  has already been taken.'
        ];
        return $request->validate($rules, $customMessages, $attribute);
    }


    public function createEdit($id = '')
    {
        $where = $this->getWhere();
        $this->data = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $this->data['allClass'] = ClassModel::where($where)->get();
        $this->data['exams'] = Exam::where($where)->orderBy('order_by')->get();
        return $this->data;
    }

    public function getWhere()
    {
        return ['vtype' => getVersionType(), 'branch_id' => getBranchId()];
    }

}
