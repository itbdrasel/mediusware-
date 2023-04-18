<?php
namespace Modules\Scms\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;

use Modules\Scms\Models\Exam;
use Modules\Scms\Models\Student;
use Modules\Scms\Services\Backend\Controller;
use Illuminate\Http\Request;
use Modules\Scms\Models\ExamRule;
use Validator;

class MarksheetController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->model            = ExamRule::class;
        $this->bUrl             = $this->moduleName.'/marksheet';
        $this->title            = 'Marksheet';
    }


    public function layout($pageName){
        echo $this->getLayout('marksheet',$pageName);
    }



    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
        $this->data = [
            'title'         =>  $this->title.' Manager',
            'pageUrl'       => $this->bUrl,
            'page_icon'     => '<i class="fas fa-tasks"></i>',
            'students'      => $this->getStudents(),
            'exams'         => Exam::where($this->getWhere())->where('type',1)->orderBy('order_by')->get(),
        ];

        $this->layout('index');
    }


    public function marksheet(Request $request){
        $this->layout('marksheet');
    }


    public function getStudents(){
        $branch_id = getBranchId();
      return  Student::select('id', 'name', 'id_number')
            ->where( ['branch_id'=>$branch_id,'vtype'=>getVersionType()])->get();
    }




}
