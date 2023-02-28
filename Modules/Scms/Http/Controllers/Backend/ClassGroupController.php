<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Core\Services\CRUDServices;
use Modules\Scms\Models\ClassCategory;
use Modules\Scms\Models\ClassGroup;

use Validator;

class ClassGroupController extends Controller
{


    private $data;
    private $bUrl;
    private $title;
    private $model;
    private $tableId;
    private $moduleName;
    private $crudServices;

    public function __construct(CRUDServices $crudServices){
        $this->moduleName       = getModuleName(get_called_class());
        $this->crudServices     = $crudServices;
        $this->model            = ClassCategory::class;
        $this->tableId          = 'id';
        $this->bUrl             = $this->moduleName.'/class-group';
        $this->title            = 'Class Group';
    }


    public function layout($pageName){

        $this->data['bUrl']         =  $this->bUrl;
        $this->data['tableID']      =  $this->tableId;
        $this->data['moduleName']   =  $this->moduleName;
        $this->data['view_path']    =  $this->moduleName.'::backend.class_group.';
        echo view( $this->data['view_path'].$pageName.'', $this->data);

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $branch_id = getBranchId();
        $this->data                 = $this->crudServices->getIndexData($request, $this->model, 'id', ['classGroups', 'classGroups.className'], ['branch_id'=>$branch_id]);
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
        $this->data['classes']  = getClass();
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
        $this->data['classes']  = getClass();

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




    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $this->model::where($this->tableId, $id)->delete();
            ClassGroup::where('category_id', $id)->delete();
            return true;
        }
        return false;

    }

    public function getValidation($request){
        $validationRules    = $this->crudServices->getValidationRules($this->model);
        $rules              = $validationRules['rules'];
        $attribute          = $validationRules['attribute'];
        $customMessages     = [];
        return Validator::make($request->all(), $rules, $customMessages, $attribute);
    }

}
