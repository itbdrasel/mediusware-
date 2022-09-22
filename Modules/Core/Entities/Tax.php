<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;


class Tax extends Model
{

    protected $table = 'tbl_tax';

	protected $fillable = [
        'tax_name', 'tax_percent'
    ];

}
