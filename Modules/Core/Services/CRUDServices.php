<?php


namespace Modules\Core\Services;

use Illuminate\Http\Request;
use Validator;

class CRUDServices{

    private $data;
    public function __construct(){

    }

    /**
     * Function validation handle by request quote from validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  false|true $session
     *
     * @return validation message
     */

    public function getIndexData($request, $model, $tableId){
        $model_sortable = $model::$sortable;
        $perPage = session('per_page') ?: 10;

        //table item serial starting from 0
        $data['serial'] = ( ($request->get('page') ?? 1) -1) * $perPage;

        if($request->method() === 'POST'){
            session(['per_page' => $request->post('per_page') ]);
        }

        //model query...
        $queryData = $model::orderBy( getOrder($model_sortable, $tableId)['by'], getOrder($model_sortable, $tableId)['order']);
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

        $data['allData'] =  $queryData->paginate($perPage)->appends( request()->query() ); // paginate
        return $data;

    }

    public function getValidationRules($model){
        $data['rules'] = [];
        $data['attribute'] = [];
        foreach ($model::$required as $key=>$value){
            if (is_string($value)){
                $data['rules'][$key]  = 'required';
                $data['attribute'][$key]  = $value;
            }else{
                $data['rules'][$value]  = 'required';
            }
        }
        return $data;
    }

    public function getInsertData($model, $request){
        $data = [];
        $array= $model::$insertData;
        for ($i=0; $i<count( $array); $i++){
            $data[$array[$i]]= $request[$array[$i]];
        }
        return $data;
    }

    public function destroy($request, $id, $model, $tableId, $bUrl, $title)
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
