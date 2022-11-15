<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    protected $table = 'scms_enroll';

    protected $fillable = [
        'student_id','id_number','class_id', 'section_id', 'group_id', 'shift', 'roll', 'year', 'vtype'
    ];

    public static $insertData = ['id_number','class_id', 'section_id', 'group_id', 'shift', 'roll', 'year', 'vtype'];

}
