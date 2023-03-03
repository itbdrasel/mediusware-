<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Models\Student;
use Modules\Scms\Services\Backend\StudentService;
use Validator;

class StudentController extends Controller
{

    private $studentServices;

    public function __construct(StudentService $studentService){
        parent::__construct();
        $this->studentServices  = $studentService;
        $this->model            = Student::class;
        $this->bUrl             = $this->moduleName.'/student';
        $this->title            = 'Student';
    }


    public function layout($pageName){
        echo $this->getLayout('student',$pageName);
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $class_id='', $section_id=''){
        $this->data                     = $this->studentServices->getIndexData($request, $class_id, $section_id);
        $this->data['sidebar_collapse'] = 'sidebar-collapse sidebar-mini';

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
    public function create(Request $request){
        $this->data                 = $this->studentServices->createEdit($request['class']);
        $this->data['section_id']   = $request['section'];
        $this->layout('create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id){

        $objData = $this->studentServices->editObjData($id);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }
        $this->data = $this->studentServices->createEdit($objData->class_id, $id);
        $this->data['objData']= $objData;
        $this->layout('create');
    }

    public function show($id){

        $objData = $this->model::where($this->tableId, $id)->first();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id || empty($objData) ){ exit('Bad Request!'); }

        $this->data = [
            'title'         => $this->title.' Information',
            'pageUrl'       => $this->bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-eye"></i>',
            'objData'       => $objData
        ];

        $this->layout('view');
    }



    /**
     * Store a newly created or Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request){
        $id = $request[$this->tableId];
        $validator =  $this->studentServices->getValidationRules($request);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->studentServices->insertData($request);
        $message = successMessage($id, $this->title);
        return redirect($this->bUrl.'/'.$request['class_id'])->with('success', $message);

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
}
