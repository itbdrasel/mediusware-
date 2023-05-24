<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $table = 'scms_marks';

    protected $fillable = [
        'exam_mark_id', 'section_id','subject_id', 'student_id', 'rules_marks','total_mark', 'letter_grade', 'grade_points', 'is_pass', 'comment',
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

}
