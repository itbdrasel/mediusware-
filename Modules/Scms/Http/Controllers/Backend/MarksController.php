<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Exam;
use Modules\Scms\Models\Mark;
use Modules\Scms\Services\Backend\Controller;

use Illuminate\Http\Request;
use Modules\Scms\Models\ClassCategory;
use Modules\Scms\Models\ClassGroup;

use Validator;

class MarksController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->model            = Mark::class;
        $this->bUrl             = $this->moduleName.'/marks';
        $this->title            = 'Mark';
    }

    public function layout($pageName){
        echo $this->getLayout('marks',$pageName);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create(){

        $this->data             = $this->crudServices->createEdit($this->title, $this->bUrl);
        $this->data['classes']  = getClass();
        $this->data['exams']    = Exam::where($this->getWhere())->where('type',1)->orderBy('order_by')->get();
        $this->layout('create');
    }




    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $id = $request[$this->tableId];
        $validator = $this->getValidation($request);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params = $this->crudServices->getInsertData($this->model, $request);
        $params['branch_id']    = getBranchId();
        $params['vtype']        = getVersionType();
        $classId                = $request['class_id'];
        if (empty($id) ) {
           $category_id = $this->model::create($params)->id;
        }else{
            $category_id = $id;
            $this->model::where($this->tableId, $id)->update($params);
            ClassGroup::where('category_id', $id)->update(['status'=>8]);
        }

        if (!empty($classId)) {
            foreach ($classId as $key => $value) {
                $groupData = [
                    'class_id' => $value,
                    'category_id' => $category_id,
                    'status' => 1,
                ];
               $group   = ClassGroup::where(['category_id'=>$id, 'class_id'=>$value])->first();
                if (!empty($group)){
                    ClassGroup::where(['category_id' =>$id, 'class_id' =>$value])->update($groupData);
                }else{
                    ClassGroup::create($groupData);
                }
            }
        }

        if (!empty($id)) {
            ClassGroup::where(['category_id'=>$id, 'status'=>8])->delete();
        }
        return redirect($this->bUrl)->with('success', successMessage($id, $this->title));

    }





    public function getWhere(){
        return ['branch_id'=> getBranchId(),'vtype'=>getVersionType()];
    }

}
