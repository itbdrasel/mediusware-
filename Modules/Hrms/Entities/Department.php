<?php

namespace Modules\Hrms\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'hrms_departments';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
