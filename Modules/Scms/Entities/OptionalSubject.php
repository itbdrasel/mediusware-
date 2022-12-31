<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class OptionalSubject extends Model
{

    protected $table = 'scms_optional_subject';

    protected $fillable = [
        'class_id', 'student_id','o_subjects','four_subject'
    ];
}
