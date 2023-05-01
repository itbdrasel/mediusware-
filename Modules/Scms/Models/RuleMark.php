<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;
 use DB;
class RuleMark extends Model
{

    protected $table = 'scms_rule_marks';

    protected $fillable = [
        'rule_mark_manage_id', 'subject_id', 'full_mark','pass_mark', 'rule_mark', 'status'
    ];
    protected $casts = [
        'rule_mark' => 'json'
    ];

    public function rules()
    {
        $ruleIds = [];

        foreach (json_decode($this->rule_mark) as $ruleId => $ruleMark) {
            $ruleIds[] = $ruleId;
        }
        return $this->hasMany(ExamRule::class)->whereIn('id', $ruleIds);
    }


    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }




}
