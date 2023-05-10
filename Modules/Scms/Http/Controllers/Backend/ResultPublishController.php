<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\StudentMark;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Models\Exam;
use Modules\Scms\Models\ResultPublish;
use Validator;

class ResultPublishController extends Controller
{
    use \Modules\Scms\Traits\ResultPublish;

    public function __construct(){
        parent::__construct();
        $this->model            = ResultPublish::class;
        $this->bUrl             = $this->moduleName.'/result-publish';
        $this->pUrl             = $this->bUrl.params();
        $this->title            = 'Result Publish';
    }


    public function layout($pageName){
        echo $this->getLayout('result_publish',$pageName);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $indexData  = $this->crudServices->indexQuery($request, $this->model, 'year');
        $query      =  $indexData['query'];
        $query->leftJoin('scms_exam', 'scms_result_publish.exam_id', '=', 'scms_exam.id');
        $query->leftJoin('scms_class', 'scms_result_publish.class_id', '=', 'scms_class.id');
        $query->select('scms_result_publish.*', 'scms_exam.name', 'scms_class.name as nameName');
        $indexData =  ['query'=>$query, 'data'=>$indexData['data']];
        $this->data                 = $this->crudServices->getQueryDataByIndex($request, $indexData);
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
        $this->data['add_title']    = 'Add New '.$this->title;
        $this->data['objData']      = [];
        $this->data['exams']        = Exam::where('vtype', getVersionType())->get();
        $this->data['allClass']     = getClass();

        if ($request->ajax() || $request['ajax']){
            return $this->layout('data');
        }

        $this->layout('index');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id){

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }

        $this->data             = $this->crudServices->createEdit($this->title, $this->bUrl,$id);
        $this->data['objData']  = $objData;
        $this->data['allClass'] = getClass();
        $this->data['exams']    = Exam::where('vtype', getVersionType())->get();

        $this->layout('edit');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $this->getValidation($request);
        $id = $request[$this->tableId];
        $params = $this->crudServices->getInsertData($this->model, $request);
        $params['vtype'] = getVersionType();
        $resultPublish = $this->resultPublish($request);
        if (empty($resultPublish['status'])){
            return redirect($this->pUrl)->with('error', $resultPublish)->withInput();
        }
        $params['exam_mark_id'] = $resultPublish['examMarkId'];
        if (empty($id) ) {
            $this->model::create($params);
            return redirect($this->pUrl)->with('success', successMessage($id, $this->title));
        }else{
            $this->model::where($this->tableId, $id)->update($params);
            return successMessage($id, $this->title);
        }

    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->model::where($this->tableId, $id)->first();
            StudentMark::where(['exam_mark_id'=>$data->exam_mark_id])->delete();
            $this->model::where($this->tableId, $id)->delete();
            return true;
        }
        return false;

    }

    public function getValidation($request){
        $validationRules    = $this->crudServices->getValidationRules($this->model);
        $rules              = $validationRules['rules'];
//        $rules['year']      = 'required|regex:/^[0-9]{4,}-[0-9]{4,}$/';
        $rules['year'] = ['required', 'regex:/^[0-9]{4,}-[0-9]{4,}$/', function ($attribute, $value, $fail) use ($request) {
            $vtype = getVersionType();
            $resultPublish = $this->model::where(['vtype'=> $vtype, 'class_id'=> $request['class_id'], 'exam_id'=> $request['exam_id'], 'year'=> $value])->where('id','!=', $request[$this->tableId])->first();
            if (!empty($resultPublish)){
                $fail(__('Exam results already published'));
            }
        }];
        $attribute          = $validationRules['attribute'];
        $customMessages     = [];

        return $request->validate($rules,$customMessages, $attribute);
    }

}
