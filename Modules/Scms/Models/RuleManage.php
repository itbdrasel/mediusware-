<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class RuleManage extends Model
{

    protected $table = 'scms_rule_manage';

    protected $fillable = [
        'rules_group_id', 'rule_id','status'
    ];

    public function ruleName(){
        return $this->belongsTo(ExamRule::class, 'rule_id', 'id');
    }


}
