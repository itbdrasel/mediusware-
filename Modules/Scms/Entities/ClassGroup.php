<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{

    protected $table = 'scms_class_group';

    protected $fillable = [
        'category_id','class_id','status'
    ];


    public static $filters = ['name'];

    public static $required = ['category_id', 'class_id'];

    public static $insertData = ['category_id','class_id'];

    public function className(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

}
