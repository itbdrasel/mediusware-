<?php


namespace Modules\Scms\Services;


use Modules\Scms\Entities\Student;

class StudentService
{

    private $model;
    public function __construct(){
        $this->model            = Student::class;
    }

    public function getIndexData($request, $class_id='', $section_id=''){
        $model_sortable =  $this->model::$sortable;
        $perPage = session('per_page') ?: 10;

        //table item serial starting from 0
        $data['serial'] = ( ($request->get('page') ?? 1) -1) * $perPage;

        if($request->method() === 'POST'){
            session(['per_page' => $request->post('per_page') ]);
        }


        $class = getClass();
        $data['allClass']     = $class;
        if (empty($class_id)) {
            $class_id = $class[0]->id??'';
        }

        //model query...
        $queryData = $this->model::orderBy( getOrder($model_sortable, 'scms_student.id')['by'], getOrder($model_sortable, 'scms_student.id')['order'])
        ->select( 'scms_student.id', 'scms_student.name', 'scms_student.phone', 'scms_student.email', 'scms_student.id_number', 'scms_student.photo')
        ->rightJoin('scms_enroll','scms_student.id', 'scms_enroll.student_id');

        //filter by text.....
        $data['filter'] ='';
        if( $request->filled('filter') ){
            $section_id ='';
            $filter =  $this->model::$filters;
            if (!empty($filter)) {
                $sl =0;
                foreach ($filter as $key=>$value){
                    $data['filter'] = $filter = $request->get('filter');
                    $sl++;
                    if ($sl ==1) {
                        $queryData->where($value, 'like', '%'.$filter.'%');
                    }else{
                        $queryData->orWhere($value, 'like', '%'.$filter.'%');
                    }
                }
            }

        }

        if (!empty($class_id)){
            $queryData->where('class_id', $class_id);
        }
        if (!empty($class_id)){
            $queryData->where('section_id', $section_id);
        }


        $data['class_id']   = $class_id;
        $data['section_id'] = $section_id;
        $data['allData']    =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        return $data;

    }

}
