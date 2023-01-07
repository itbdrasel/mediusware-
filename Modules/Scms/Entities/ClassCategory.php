<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{

    protected $table = 'scms_class_categories';

    protected $fillable = [
        'name','start_year','end_year','vtype'
    ];


    public static $sortable = ['id','name'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','start_year','end_year'];

}
