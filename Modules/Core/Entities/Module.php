<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;


class Module extends Model
{

    protected $table = 'tbl_modules';

	protected $fillable = [
        'name', 'slug', 'status'
    ];

    public static $sortable = ['id','name','slug'];

    public static $filters = ['name','slug'];

    public static $required = ['name', 'slug', 'status'];

    public static $attribute = [];

    public static $insertData = ['name', 'slug', 'status'];

}
