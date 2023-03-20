<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class RulesGroup extends Model
{

    protected $table = 'scms_rules_group';

    protected $fillable = [
        'class_id','exam_id','start_year','end_year','branch_id', 'vtype'
    ];

    public static $sortable = ['class_id'];

    public static $filters = [''];

    public static $required = ['class_id','exam_id'=>'Exam'];

    public static $insertData = ['class_id','exam_id','start_year','end_year'];


    public function ruleManages(){
        return $this->hasMany(RuleManage::class, 'rules_group_id', 'id');
    }

    public function className(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }


}
