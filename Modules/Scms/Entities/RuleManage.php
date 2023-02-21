<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class RuleManage extends Model
{

    protected $table = 'scms_rule_manage';

    protected $fillable = [
        'class_group_rule_id', 'rule_id','status'
    ];


}
