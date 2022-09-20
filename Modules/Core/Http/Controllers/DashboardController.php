<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    private $model;
    private $data;
    private $tableId;
    private $bUrl;
    private $title;

    public function __construct(){
        $this->tableId      = 'id';
        $this->model        = '';
        $this->moduleName   = 'core';
        $this->bUrl         = $this->moduleName.'/dashboard';
        $this->title        = 'Dashboard';
    }

    public function layout($pageName){
        $this->data['tableID']  = $this->tableId;
        $this->data['bUrl']     = $this->bUrl;

//        echo view($this->moduleName.'::rooms.'.$pageName.'', $this->data);
        echo view($this->moduleName.'::pages.'.$pageName.'', $this->data);

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
