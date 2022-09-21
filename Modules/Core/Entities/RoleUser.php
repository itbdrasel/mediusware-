<?php

namespace Modules\Core\Entities;

use Modules\Core\Entities\Roles;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public function roleName(){
        return $this->hasOne(Roles::class, 'id','role_id');
    }
}
