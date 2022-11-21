<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Routing\Controller;

class AjaxJsonController extends Controller
{

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
    }


    public function runningYearStatic(){
            $year_format    = config('sc_setting.r_year_format');
            $html = '<select id="running_year_top" name="running_year_top" class="form-select ">';
            for($x = 0; $x <= 10; $x++){

            }
        $html .='</select>';
    }
}
