<?php

namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Scms\Entities\Section;
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

    public function classBySections(Request $request){
        $rules = [
            'class_id'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return false;
        }
        $sections = Section::where('id', $request['class_id'])->select('id','name')->get();
        return response()->json($sections);
    }
}
