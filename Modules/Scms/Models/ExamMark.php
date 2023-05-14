<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{

    protected $table = 'scms_exam_mark';

    protected $fillable = [
        'class_id', 'exam_id', 'branch_id','year', 'vtype'
    ];

    public static $sortable = ['id','year'];

    public function marks(){
        return $this->hasMany(Mark::class, 'exam_mark_id', 'id');
    }

    public function className(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function studentsMarks(){
        return $this->hasMany(StudentMark::class, 'exam_mark_id');
    }
}
