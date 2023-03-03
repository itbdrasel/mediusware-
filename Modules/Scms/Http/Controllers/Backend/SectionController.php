<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Models\Section;
use Modules\Scms\Models\Shift;
use Validator;

class SectionController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->model            = Section::class;
        $this->bUrl             = $this->moduleName.'/section';
        $this->title            = 'Section';
    }


    public function layout($pageName){
        echo $this->getLayout('section',$pageName);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $id=''){
        $this->data = [
            'title'         => $this->title.' Manager',
            'pageUrl'       => $this->bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
        ];
        $this->data['add_title'] = 'Add New '.$this->title;
        $class = getClass();
        $this->data['allClass'] = $class;

        if (empty($id)) {
            $id = $class[0]->id??'';
        }
        if ($request->filled('filter')) {
            $id ='';
            $this->data['filter'] = $filter = $request->get('filter');
        }

        $all_data = $this->crudServices->getIndexData($request, $this->model, 'order_by', ['teacher', 'shift'], ['class_id'=>$id]);

        $this->data['allData']  = $all_data['allData']; // paginate
        $this->data['serial']   = $all_data['serial'];
        $this->data['id']       = $id;

        if ($request->ajax() || $request['ajax']){
            return $this->layout('data');
        }

        $this->layout('index');
    }


    /**
     * Show the form for create the specified resource.
     * @return Renderable
     */
    public function create(){
        $this->data                     = $this->createEdit();
        return $this->layout('edit');
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

        $this->data             = $this->createEdit($id);
        $this->data['objData']  = $objData;

        return $this->layout('edit');
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
        if (empty($id) ) {
            $this->model::create($params);
            return successMessage($id, $this->title);
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
            $this->model::where($this->tableId, $id)->delete();
            return true;
        }
        return false;
    }

    public function getValidation($request){
        $validationRules = $this->crudServices->getValidationRules($this->model);
        $rules =$validationRules['rules'];
        $attribute =$validationRules['attribute'];
        $customMessages = [];
        return $request->validate($rules,$customMessages, $attribute);
    }


    public function createEdit($id=''){
        $this->data             = $this->crudServices->createEdit($this->title, $this->bUrl, $id);
        $this->data['teachers'] = getTeacher();
        $this->data['allClass'] = getClass();
        $this->data['shifts']   = Shift::orderBy('order_by')->get();
        return $this->data;
    }




}
