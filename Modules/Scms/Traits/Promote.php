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
            "class_id"              => "required",
            "section_id"            => "required",
            "promote_year"          => "required",
            "promote_class_id"      => "required",
            "promote_section_id"    => "required",
        ];

        $attribute = [
            "class_id"              => "class",
            "section_id"            => "section",
            "promote_year"          => "promote year",
            "promote_class_id"      => "promote class",
            "promote_section_id"    => "promote section",
        ];

        return $request->validate($rules, [], $attribute);
    }

    public function getPromoteStudentCheck($request, $student_id){
        $year       = getDbRunningYear($request['promote_year']);
        $class_id   = $request['promote_class_id'];

        $student    = Enroll::where(['year'=> $year, 'class_id'=> $class_id, 'student_id'=>$student_id])->count();

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
          ->select('student_id','class_id', 'section_id', 'group_id', 'shift', 'roll')
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


    public function getValidation($request)
    {
        $rules = [
            "class_id"              => "required",
            "section_id"            => "required",
            "promote_year"          => "required",
            "promote_class_id"      => "required",
            "promote_section_id"    => "required",
            "students.*"            => "required",
            "section.*"             => "required",
            "role.*"                => "required",
            "status.*"              => "required",
        ];

        $attribute = [
            "class_id"              => "class",
            "section_id"            => "section",
            "promote_year"          => "promote year",
            "promote_class_id"      => "promote class",
            "promote_section_id"    => "promote section",
        ];
        return $request->validate($rules, [], $attribute);
    }
}
