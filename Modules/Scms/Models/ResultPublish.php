<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ResultPublish extends Model
{

    protected $table = 'scms_result_publish';

    protected $fillable = [
        'exam_mark_id', 'exam_id','class_id','year','vtype'
    ];


    public static $sortable = ['id','scms_exam.name','year'];

    public static $filters = ['scms_exam.name','scms_class.name','year'];

    public static $required = ['exam_id'=>'exam', 'class_id'=>'class', 'year'];

    public static $insertData = ['exam_id','year','class_id','vtype'];

}
