<?php


namespace Modules\Scms\Services\Backend;
use Illuminate\Routing\Controller as LaravelController;

use Modules\Core\Services\CRUDServices;
class Controller extends LaravelController
{

    protected $data;
    protected $bUrl;
    protected $title;
    protected $model;
    protected $auth;
    protected $tableId      ='id';
    protected $moduleName;
    protected $crudServices;
    protected $branch_id;
    protected $vtype;

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
        $this->crudServices     = new CRUDServices();
        $this->branch_id        = getBranchId();
        $this->vtype            = getVersionType();

    }

    protected function getLayout($pathName,$pageName){
        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;
        $this->data['view_path']    =  "{$this->moduleName}::backend.{$pathName}.";
        echo view( $this->data['view_path'].$pageName.'', $this->data);

    }



}
