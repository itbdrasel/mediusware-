<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class SettingSC extends Model
{
    protected $table = 'scms_settings';
    protected $fillable = [
        'name','value'
    ];

}
