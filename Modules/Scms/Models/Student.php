<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'scms_student';

    protected $fillable = [
        'id_number', 'name', 'phone', 'email', 'password','birthday', 'gender_id', 'religion_id', 'blood_group_id', 'address', 'photo', 'parent_id', 'dormitory_id', 'transport_id', 'agent_banking_no','branch_id','status'
    ];

    public static $sortable = ['id_number'];

    public static $filters = ['scms_student.id_number','name','phone', 'email'];

    public static $insertData = ['id_number', 'name', 'phone', 'email', 'gender_id', 'religion_id', 'blood_group_id', 'address','dormitory_id', 'transport_id', 'agent_banking_no'];



}
