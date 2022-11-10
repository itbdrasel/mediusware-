<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    private $model;
    private $data;
    private $tableId;
    private $bUrl;
    private $title;

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
        $this->tableId          = 'id';
        $this->model            = '';
        $this->bUrl             = $this->moduleName.'/dashboard';
        $this->title            = 'Dashboard';
    }

    public function layout($pageName){
        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;

        echo view($this->moduleName.'::backend.'.$pageName.'', $this->data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $this->data = [
            'title'         => $this->title,
            'pageUrl'       => $this->bUrl,
        ];

        $this->layout('dashboard');
    }
}
