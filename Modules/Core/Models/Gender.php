<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    protected $table = 'tbl_gender';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
