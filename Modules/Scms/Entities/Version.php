<?php

namespace Modules\Scms\Entities;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table = 'scms_versions';

    protected $fillable = [
        'name'
    ];

}
