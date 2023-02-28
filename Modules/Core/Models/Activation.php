<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;


class Activation extends Model
{
	protected $fillable = [
        'user_id', 'code', 'completed', 'completed_at'
    ];

}
