<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'tbl_branch';

    protected $fillable = [
        'name', 'slug','phone', 'email', 'address', 'ssl_store_id', 'ssl_password', 'description', 'order_by','status'
    ];

    public static $sortable = ['id','name','phone'];

    public static $filters = ['name','phone'];

    public static $required = ['name','phone', 'email', 'address'];

    public static $insertData = ['name', 'slug','phone', 'email', 'address', 'ssl_store_id', 'ssl_password', 'description','order_by', 'status'];
}
