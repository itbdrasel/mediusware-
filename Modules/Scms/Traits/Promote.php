<?php


namespace Modules\Scms\Traits;


use Modules\Scms\Models\Enroll;

trait Promote
{
    protected $model;
    protected $bUrl;
    protected $title;
    public function __construct()
    {
        $this->model = Enroll::class;
        $this->bUrl = $this->moduleName . '/promote';
        $this->title = 'Promote';
    }

    public function getWhere()
    {
        return ['vtype' => getVersionType(), 'branch_id' => getBranchId()];
    }

    public function createValidation($request)
    {
        $rules = [
            "class_id"      => "required",
            "section_id"    => "required",
            "p_year"        => "required",
            "p_class_id"    => "required",
            "p_section_id"  => "required",
        ];

        $attribute = [
            "class_id"      => "class",
            "section_id"    => "section",
            "p_year"        => "promote year",
            "p_class_id"    => "promote class",
            "p_section_id"  => "promote section",
        ];

        return $request->validate($rules, [], $attribute);
    }

    public function getPromoteStudentCheck($request){
        $year       = getDbRunningYear($request['p_year']);
        $class_id   = $request['p_class_id'];
        $sectuib_id = $request['p_section_id'];

        $student    = Enroll::where(['year'=> $year, 'class_id'=> $class_id, 'section_id'=>$sectuib_id])->count();

        return $student >0?true:false;

    }

    public function getStudents($request){
        $year       = getDbRunningYear(getRunningYear());
        $class_id   = $request['class_id'];
        $section_id = $request['section_id'];
        return Enroll::where(['year'=> $year, 'class_id'=>$class_id, 'section_id'=>$section_id])
            ->with(['student' => function ($query) {
                $query->select('id','name', 'id_number');
            }])
          ->select('roll', 'student_id')
            ->get();
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
