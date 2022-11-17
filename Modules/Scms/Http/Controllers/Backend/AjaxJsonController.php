<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Routing\Controller;

class AjaxJsonController extends Controller
{

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
    }


    public function runningYearStatic(){
        return 'ok';
    }
}
