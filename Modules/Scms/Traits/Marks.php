<?php


namespace Modules\Scms\Traits;


use Modules\Scms\Models\Enroll;
use Modules\Scms\Models\Mark;
use Modules\Scms\Models\RulesGroup;

trait Marks
{
    protected $model;
    protected $bUrl;
    protected $title;

    public function __construct()
    {
        parent::__construct();
        $this->model    = Mark::class;
        $this->bUrl     = $this->moduleName . '/marks';
        $this->title    = 'Marks';
    }

    public function getWhere()
    {
        return ['vtype' => getVersionType(), 'branch_id' => getBranchId()];
    }

    public function indexValidation($request)
    {
        $rules = [
            'class_id'      => 'required',
            'exam_id'       => 'required',
            'subject_id'    => 'required',
        ];

        $attribute = [
            'class_id' => 'class',
            'exam_id' => 'exam',
            'subject_id' => 'subject'
        ];
        $customMessages = [];

        return $request->validate($rules, $customMessages, $attribute);
    }


    public function getRulesGroup($classId, $examId){
        $year = getTopBerYear(1);
        $rulesGroup   = RulesGroup::where($this->getWhere())->where(['class_id' => $classId, 'exam_id' => $examId])
            ->where('start_year', '<=', $year)
            ->where('end_year', '>=', $year);

        if ($rulesGroup->count() === 0) {
            $rulesGroup = RulesGroup::where($this->getWhere())->where(['class_id' => $classId, 'exam_id' => $examId])
                ->whereNull('start_year')
                ->whereNull('end_year');
        }
       return $rulesGroup->first();
    }

    public function getStudents($request){
        $where = [
            'class_id'  => $request['class_id'],
            'year'      => getRunningYear(),
            'vtype'     => getVersionType()
        ];

        if ($request['section_id']){
            $where['section_id'] = $request['section_id'];
        }

       return Enroll::where($where)->with('student')->get();
    }

    public function getMarks($request){
        return $this->model::where($this->getMarkWhere($request))
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->student_id => [
                    'rules_marks' => $item->rules_marks,
                    'comment' => $item->comment,
                ]];
            });;

    }

    public function getMarkWhere($request){
       return [
            'class_id'      => $request['class_id'],
            'exam_id'       => $request['exam_id'],
            'subject_id'    => $request['subject_id'],
            'year'          => getRunningYear(),
            'vtype'         => getVersionType(),
        ];

    }
}
