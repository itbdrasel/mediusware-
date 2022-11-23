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
            $html   = '<select id="running_year_top" name="running_year_top" class="form-select ">';
            $year   = date('Y')-5;
            $year_2 = $year+1;
            for($x = 0; $x <= 10; $x++){
                $y = $year+$x;
                $y_2 = $year_2+$x;
                $html.= '<option value="'.$y.'-'.$y_2.'"></option>';
            }
        $html .='</select>';
    }
}
