<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{

    protected $table = 'tbl_religion';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
