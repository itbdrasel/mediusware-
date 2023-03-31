<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Grade;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Validator;

class GradesController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->model            = Grade::class;
        $this->bUrl             = $this->moduleName.'/grade';
        $this->title            = 'Grade';
    }


    public function layout($pageName){
        echo $this->getLayout('grade',$pageName);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){


        $this->data                 = $this->crudServices->getIndexData($request, $this->model, 'grade_point' , '', $this->getWhere());
        $this->data['title']        = $this->title.' Manager';
        $this->data['pageUrl']      = $this->bUrl;
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
    public function create(){

        $this->data             = $this->crudServices->createEdit($this->title, $this->bUrl);
        $this->layout('create');
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

        $this->layout('create');
    }


    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $id = $request[$this->tableId];
        $this->getValidation($request);

        $params = $this->crudServices->getInsertData($this->model, $request);
        $params['vtype']        = getVersionType();
        if (empty($id) ) {
            $this->model::create($params);
        }else{
            $this->model::where($this->tableId, $id)->update($params);
        }
        return redirect($this->bUrl)->with('success', successMessage($id, $this->title));

    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->model::where($this->tableId, $id)->delete();
            return true;
        }
        return false;

    }


    public function getValidation($request){
        $validationRules    = $this->crudServices->getValidationRules($this->model);
        $rules              = $validationRules['rules'];
        $attribute          = $validationRules['attribute'];
        $customMessages     = [];
        return $request->validate($rules,$customMessages, $attribute);
    }

    public function getWhere(){
        return ['vtype'=>getVersionType()];
    }

}
