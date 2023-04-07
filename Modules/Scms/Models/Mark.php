<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $table = 'scms_marks';

    protected $fillable = [
        'exam_mark_id', 'section_id','subject_id', 'student_id', 'rules_marks',  'comment',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

}
