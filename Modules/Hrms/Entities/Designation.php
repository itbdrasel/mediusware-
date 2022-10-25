<?php

namespace Modules\Hrms\Entities;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{

    protected $table = 'hrms_designations';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
