<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ModuleSection extends Model
{

    protected $table = 'tbl_module_sections';

    protected $primaryKey = 'section_id';

	protected $fillable = [
        'section_name', 'section_module_name', 'section_action_route', 'section_roles_permission'
    ];

}
