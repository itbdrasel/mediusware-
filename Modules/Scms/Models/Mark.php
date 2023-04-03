<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $table = 'scms_marks';

    protected $fillable = [
        'class_id', 'exam_id', 'section_id', 'student_id', 'rules_marks', 'full_mark', 'total_pass_subject', 'comment', 'year', 'vtype'
    ];




}
