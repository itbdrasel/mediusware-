<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;


class Module extends Model
{

    protected $table = 'tbl_modules';

	protected $fillable = [
        'name', 'slug', 'status'
    ];

    public static $sortable = ['id','name','slug'];

    public static $filters = ['name','slug'];

    public static $required = ['name', 'slug', 'status'];

    public static $attribute = [];

    public static $insertData = ['name', 'slug', 'status'];

    public function sections(){
        return $this->hasMany(ModuleSection::class, 'module_id','id');
    }

    public function getFeaturedSections($role_id)
    {
        return $this->sections()->orderBy('section_name')->orderBy('id')->whereJsonContains('section_roles_permission', [(string)$role_id])->get();
    }

}
