<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class RuleMarkManage extends Model
{

    protected $table = 'scms_rule_mark_manage';

    protected $fillable = [
        'exam_id', 'class_id', 'start_year', 'end_year', 'calculation_subject', 'branch_id', 'vtype'
    ];

    public static $sortable = ['exam_id', 'class_id'];

    public static $filters = [''];

    public static $required = ['class_id'=>'Class','exam_id'=>'Exam', 'calculation_subject'=>'Total Grade Calculation By Subject'];

    public static $insertData = [ 'exam_id', 'class_id', 'start_year', 'end_year', 'calculation_subject'];


    public function className(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function ruleMarks(){
        return $this->hasMany(RuleMark::class, 'rule_mark_manage_id', 'id');
    }

}
