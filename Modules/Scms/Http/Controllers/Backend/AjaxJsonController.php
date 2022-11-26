<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Scms\Entities\SettingSC;
use Validator;

class AjaxJsonController extends Controller
{

    public function __construct(){
        $this->moduleName       = getModuleName(get_called_class());
    }
    public function runningYearChange(Request $request){
        $rules = [
            'year'=> 'required|regex:/^[0-9]{4,}-[0-9]{4,}$/'
        ];
        $attribute = [];
        $customMessages = [];
        $validator = Validator::make($request->all(), $rules, $customMessages, $attribute);
        if ($validator->fails()){
            return false;
        }
        $year = $request['year'];
        SettingSC::where('name', 'running_year')->update(['value'=>$year]);
        return true;

    }
}
