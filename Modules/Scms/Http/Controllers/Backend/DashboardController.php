<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Scms\Services\Backend\Controller;

class DashboardController extends Controller
{

    public function __construct(){
        parent::__construct();
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

    public function branchManage($id){
        session()->put('_branch_id', $id);
        return redirect($this->bUrl);
    }
}
