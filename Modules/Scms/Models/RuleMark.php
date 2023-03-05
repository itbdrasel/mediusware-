<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class RuleMark extends Model
{

    protected $table = 'scms_rule_marks';

    protected $fillable = [
        'rule_marks_manage_id', 'subject_id', 'full_mark', 'rule_id', 'pass_mark', 'status'
    ];
    

}
