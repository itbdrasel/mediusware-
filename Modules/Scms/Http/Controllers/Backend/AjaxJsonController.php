<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Scms\Entities\SettingSC;

class AjaxJsonController extends Controller
{

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
    }
    public function runningYearChange(Request $request){
        $year = $request['year'];
        SettingSC::where('name', 'running_year')->update(['value'=>$year]);
    }
}
