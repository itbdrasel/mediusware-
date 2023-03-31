<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    protected $table = 'scms_grades';

    protected $fillable = [
        'name', 'grade_point', 'full_mark', 'mark_from', 'mark_upto', 'out_of_id', 'comment', 'vtype', 'status'
    ];

    public static $sortable = [ 'name', 'grade_point', 'full_mark', 'mark_from', 'mark_upto', 'out_of_id', 'status'];

    public static $filters = ['name', 'grade_point', 'full_mark', 'mark_from', 'mark_upto'];

    public static $required = ['name','grade_point','full_mark','mark_from', 'mark_upto', 'out_of_id'=>'Out of', 'status'];

    public static $insertData = [ 'name', 'grade_point', 'full_mark', 'mark_from', 'mark_upto', 'out_of_id', 'comment', 'status'];

}
