<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Exam;
use Modules\Scms\Models\Mark;
use Modules\Scms\Models\RulesGroup;
use Modules\Scms\Models\Section;
use Modules\Scms\Models\Subject;
use Modules\Scms\Services\Backend\Controller;

use Illuminate\Http\Request;
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
    public function index(Request $request){

        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'objData'       =>''
        ];
        $this->data['allClass']  = getClass();
        $this->data['exams']    = Exam::where($this->getWhere())->where('type',1)->orderBy('order_by')->get();

        if ($request['_method'] === 'POST') {
            $class_id = $request['class_id'];
            $exam_id = $request['exam_id'];

            $rulesGroup = RulesGroup::where($this->getWhere())->where(['class_id' => $class_id, 'exam_id' => $exam_id])
                ->with('ruleManages')
                ->get();
            $rules = [
                'class_id'      => 'required',
                'exam_id'       => 'required',
                'subject_id'    => ['required', function ($attribute, $value, $fail) use ($request){

                }],
            ];
            $attribute = [
                'class_id'  => 'class',
                'exam_id'   => 'exam',
                'subject_id' => 'subject'
            ];
            $customMessages = [];
            $validator = Validator::make($request->all(), $rules,$customMessages, $attribute);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $this->layout('index');
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


    public function getSectionsSubjects(Request $request){
        if (!$request->ajax()){
            return response("Bad Request!", 422);
        }
        $classId = $request['class_id'];
        $classId = filter_var($classId, FILTER_VALIDATE_INT);
        if($classId){
            $sections = Section::where('class_id', $classId)->orderBy('order_by')->get();
            $subjects = Subject::where('class_id', $classId)->orderBy('order_by')->get();
            $data = [
                'sections'=> $sections,
                'subjects'=> $subjects,
            ];
            return response(json_encode($data), 200);
        }

    }

}
