<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;


class ModuleSection extends Model
{

    protected $table = 'tbl_module_sections';

    protected $primaryKey = 'id';

	protected $fillable = [
        'section_name', 'module_id', 'section_action_route', 'section_roles_permission'
    ];

	public function module(){
	    return $this->belongsTo(Module::class);
    }

}