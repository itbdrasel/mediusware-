<?php

namespace App\Models;

use App\Roles;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public function roleName(){
        return $this->hasOne(Roles::class, 'id','role_id');
    }
}
