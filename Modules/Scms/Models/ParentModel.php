<?php

namespace Modules\Scms\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{

    protected $table = 'scms_parent';

    protected $fillable = [
        'name', 'phone', 'email', 'address', 'profession', 'password', 'father_name', 'father_contact', 'father_profession','mother_name', 'mother_contact', 'mother_profession'
    ];

    public static $insertData = ['name', 'phone', 'email', 'address', 'profession', 'father_name', 'father_contact', 'mother_name', 'mother_contact'];


}
