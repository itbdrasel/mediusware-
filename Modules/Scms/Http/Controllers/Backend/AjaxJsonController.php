<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Routing\Controller;

class AjaxJsonController extends Controller
{

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
    }


    public function runningYearStatic(){
            $year           = date('Y')-10;
            $year_2         = $year+1;
            $html           = '<select id="running_year_top" name="running_year_top" class="form-select ">';
            for($x = 0; $x <= 10; $x++){

                $y          = $year+$x;
                $y_2        = $year_2+$x;
                $formatYear = $y.'-'.$y_2;
                $selected   = $formatYear==getRunningYear()?'selected':'';

                $html.= '<option '.$selected.' value="'.$formatYear.'">'.getFormatYear($formatYear).'</option>';
            }
        $html .='</select>';
    return $html;
    }
}
