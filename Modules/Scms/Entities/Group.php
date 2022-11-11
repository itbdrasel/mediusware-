<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'scms_groups';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
