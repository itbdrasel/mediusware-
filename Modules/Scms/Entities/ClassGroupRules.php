<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassGroupRules extends Model
{

    protected $table = 'scms_class_group_rules';

    protected $fillable = [
        'class_group_id','exam_id', 'branch_id', 'vtype'
    ];

    public static $sortable = ['class_group_id'];

    public static $filters = [''];

    public static $required = ['class_group_id','exam_id'=>'Exam'];

    public static $insertData = ['class_group_id','exam_id'];


    public function ruleManages(){
        return $this->hasMany(RuleManage::class, 'class_group_rule_id', 'id');
    }

    public function classGroup(){
        return $this->belongsTo(ClassCategory::class, 'class_group_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }


}
