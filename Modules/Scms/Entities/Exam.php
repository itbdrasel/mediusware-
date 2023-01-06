<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    protected $table = 'scms_exam';

    protected $fillable = [
        'name', 'prent_id', 'type', 'comment', 'order_by', 'vtype'
    ];


    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name','type'];

    public static $insertData = ['name', 'prent_id', 'type', 'comment', 'order_by'];

}
