<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{

    protected $table = 'scms_exam_mark';

    protected $fillable = [
        'class_id', 'exam_id', 'year', 'vtype'
    ];

    public static $sortable = ['id','year'];

}
