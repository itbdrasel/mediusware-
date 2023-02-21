<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class ExamRule extends Model
{

    protected $table = 'scms_exam_rules';

    protected $fillable = [
        'name', 'code', 'branch_id', 'order_by'
    ];

    public static $sortable = ['name', 'code', 'order_by'];

    public static $filters = ['name', 'code', 'order_by'];

    public static $required = ['name', 'code'];

    public static $insertData = ['name', 'code', 'order_by'];

}
