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

    public static $insertData = ['class_group_id','exam_id'];

}
