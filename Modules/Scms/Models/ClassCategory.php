<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{

    protected $table = 'scms_class_categories';

    protected $fillable = [
        'name','start_year','end_year','branch_id','vtype'
    ];


    public static $sortable = ['id','name'];

    public static $filters = ['name'];

    public static $required = ['name'];

    public static $insertData = ['name','start_year','end_year'];


    public function classGroups(){
        return $this->hasMany(ClassGroup::class, 'category_id', 'id');
    }

}
