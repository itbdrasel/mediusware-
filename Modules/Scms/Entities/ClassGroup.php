<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{

    protected $table = 'scms_class_group';

    protected $fillable = [
        'category_id','class_id'
    ];


    public static $sortable = ['id','name'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','start_year','end_year'];

}
