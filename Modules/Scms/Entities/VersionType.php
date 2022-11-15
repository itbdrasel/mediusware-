<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class VersionType extends Model
{
    protected $table = 'scms_version_type';
    protected $fillable = [
        'name','status'
    ];

}
