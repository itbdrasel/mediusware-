<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    protected $table = 'scms_enroll';

    protected $fillable = [
        'student_id','class_id', 'section_id', 'group_id', 'shift', 'roll', 'year', 'vtype'
    ];

    public static $insertData = ['class_id', 'section_id', 'group_id', 'shift', 'roll'];

    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

}
