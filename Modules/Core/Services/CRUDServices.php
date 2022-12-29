<?php


namespace Modules\Core\Services;

use Illuminate\Http\Request;
use Validator;

class CRUDServices{

    private $data;
    public function __construct(){

    }

    public function getIndexData($request, $model, $tableId, $with='', $where=''){
        $perPage = $this->getPerPage($request);
        $indexData = $this->indexQuery($request, $model, $tableId, $with, $where);
        //model query...
        $data = $indexData['data'];

        //model query...
        $queryData = $indexData['query'];
        //table item serial starting from 0
        $data['serial'] = ( ($request->get('page') ?? 1) -1) * $perPage;
        $data['allData'] =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        return $data;

    }

    public function getPerPage($request){
        $perPage = session('per_page') ?: 10;
        if($request->method() === 'POST'){
            session(['per_page' => $request->post('per_page') ]);
        }
        return $perPage;
    }

    public function indexQuery($request, $model, $tableId, $with='', $where=''){
        $model_sortable = $model::$sortable;
        $queryData = $model::orderBy( getOrder($model_sortable, $tableId)['by'], getOrder($model_sortable, $tableId)['order']);
        if (!empty($with)){
            $queryData->with($with);
        }
        if (!empty($where)){
            $queryData->where($where);
        }
        //filter by text.....
        $data['filter'] ='';
        if( $request->filled('filter') ){
            $filter = $model::$filters;
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
        return ['data'=>$data, 'query'=>$queryData];
    }

    public function createEdit($title, $bUrl,$id=''){
        if (!empty($id)){
            $data = [
                'title'         => 'Edit '.$title,
                'pageUrl'       => $bUrl.'/'.$id.'/edit',
                'page_icon'     => '<i class="fas fa-edit"></i>',
            ];
        }else{
            $data = [
                'title'         => 'Add New '.$title,
                'pageUrl'       => $bUrl.'/create',
                'page_icon'     => '<i class="fas fa-plus"></i>',
                'objData'       => ''
            ];
        }
        return $data;
    }

    public function show($title,$bUrl, $id){
       return $data = [
            'title'         => $title.' Information',
            'pageUrl'       => $bUrl.'/'.$id,
            'page_icon'     => '<i class="fas fa-eye"></i>',
        ];
    }

    public function getValidationRules($model, $rules=[], $attribute=[]){
        $data['rules'] = $rules;
        $data['attribute'] = $attribute;
        foreach ($model::$required as $key=>$value){
            if (!is_int($key)){
                $data['rules'][$key]  = 'required';
                $data['attribute'][$key]  = $value;
            }else{
                $data['rules'][$value]  = 'required';
            }
        }
        return $data;
    }

    public function getInsertData($model, $request, $data = []){
        $array= $model::$insertData;
        for ($i=0; $i<count( $array); $i++){
            $data[$array[$i]]= $request[$array[$i]]??NULL;
        }
        return $data;
    }

    public function destroy($id, $model, $tableId, $bUrl, $title)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if( !$id ){ exit('Bad Request!'); }

        $data = [
            'title'     => 'Delete '.$title,
            'pageUrl'   => $bUrl.'/delete/'.$id,
            'page_icon' => '<i class="fa fa-trash"></i>',
            'objData'   => $model::where($tableId, $id)->first(),
        ];

        $data['tableID']    = $tableId;
        $data['bUrl']       = $bUrl;

        return view('core::layouts.include.delete', $data);

    }


}
