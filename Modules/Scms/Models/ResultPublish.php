<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ResultPublish extends Model
{

    protected $table = 'scms_result_publish';

    protected $fillable = [
        'exam_id','class_id','year','vtype'
    ];


    public static $sortable = ['id','year'];

    public static $filters = ['name','year'];

    public static $required = ['exam_id'];

    public static $insertData = ['exam_id','year','vtype'];

}
