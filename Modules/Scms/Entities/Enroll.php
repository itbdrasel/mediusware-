<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    protected $table = 'scms_enroll';

    protected $fillable = [
        'student_id','class_id', 'section_id', 'group_id', 'shift', 'roll', 'year', 'vtype'
    ];

    public static $insertData = ['class_id', 'section_id', 'group_id', 'shift', 'roll'];

    public function optionalSubject(){
        return $this->hasMany(Subject::class,  'class_id')->where('subject_type',4);
    }
    public function fourSubject(){
        return $this->hasMany(Subject::class, 'class_id')->where('subject_type',3);
    }

}
