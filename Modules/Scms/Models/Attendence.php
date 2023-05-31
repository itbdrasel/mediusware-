<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{

    protected $table = 'scms_attendances';

    protected $fillable = [
        'student_id', 'class_id', 'section_id', 'attendanc_type', 'note', 'date'
    ];

    public function student(){
        return $this->hasOne(Student::class);
    }
}
