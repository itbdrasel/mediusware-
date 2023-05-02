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


    public function ruleMakr(){
        return $this->hasOne(Mark::class, 'subject_id', 'subject_id');
    }


    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }




}
