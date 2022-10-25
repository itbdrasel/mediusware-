<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{

    protected $table = 'tbl_blood_groups';

    protected $fillable = [
        'name', 'order_by'
    ];

    public static $sortable = ['id','name','order_by'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','order_by'];
}
