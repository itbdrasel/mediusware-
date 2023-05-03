<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{

    protected $table = 'scms_student_mark';

    protected $fillable = [
        'exam_mark_id', 'student_id', 'section_id', 'total_mark', 'letter_grade', 'grade_points', 'pass_subject'
    ];



}
