<?php




/* * *
 * Get the available Auth instance.
 *
 * @return App\Repositories\AuthInterface
 */

function dAuth(){
    return app('Modules\Core\Repositories\AuthInterface');
}

/**
 * Format a currency amount with symbol and order based on application settings.
 *
 * @param float  $amount  The currency amount to format.
 * @param bool   $format  If true, format the amount with commas and 2 decimal places.
 * @param bool   $symbol  If true, include the currency symbol.
 * @return string         The formatted currency string.
 */

function currency($amount, $format = false, $symbole=true){

    $c_symbol = Config::get('settings.c_symbol');
    $symbol_str = $symbole ? $c_symbol : '';
    $formatted_amount = $format ? number_format((float) $amount, 2, '.', ',') : floatval($amount);

    if (Config::get('settings.c_order') === 'left') {
        return $symbol_str . ' ' . $formatted_amount;
    } else {
        return $formatted_amount . ' ' . $symbol_str;
    }
}


/**
 * Generate Laravel resource routes based on array of route names.
 *
 * @param  array  $routeNames  Array of route names to generate
 * @param  bool   $matchCreate  Indicates if create route should match both GET and POST methods
 * @param  bool   $matchDelete  Indicates if delete route should match both GET and POST methods
 * @return void
 */

function getResourceRoute($array, $match=true, $match_2=true){
    $route =  Illuminate\Support\Facades\Route::class;

    for ($i=0; $i<count($array); $i++) {
        switch ($array[$i]) {
            case "index":
                if ($match) {
                    $route::match(['get', 'post'], '/', 'index')->name('');
                }else{
                    $route::get('/', 'index')->name('');
                }
                break;
            case "store":
                $route::post('/store', 'store')->name('.store');
                break;
            case "create":
                $route::get('/create', 'create')->name('.create');
                break;
            case "edit":
                $route::get('/{id}/edit', 'edit')->name('.edit');
                break;
            case "update":
                $route::post('/update','update')->name('.update');
                break;
            case "show":
                $route::get('/{id}', 'show')->name('.show');
                break;
            case "delete":
                if ($match_2) {
                    $route::match(['get', 'post'], '/delete/{id}','destroy')->name('.delete');
                }else{
                    $route::get( '/delete/{id}','destroy')->name('.delete');
                }
                break;
        }
    }
}




/*****
 * validation_errors()
 * formating validation errors for views
 **/

function validation_errors($errors){
    if($errors->any()){
        echo '<div style="padding-left: 0; " class="alert alert-danger"><ul style="margin-bottom: 0">';
        foreach ($errors->all() as $error){
            echo '<li>'.$error.'</li>';
        }
        echo '</ul></div>';
    }
}

/*****
 * getOrder()
 * sorting table fields by asc or desc
 ***
 * @$fields must be indexed array.
 * @$default must need a db table field name.
 **/

function getOrder($fields, $default){

    $getOrder = [];
    if (empty(Request::get('order')) && $default=='order_by') {
        $order =1;
    }else{
        $order = Request::get('order') ?? 2;
    }
  // OrderStatus asc or desc;
    $by = Request::get('by'); // by field name;

    //define ASC or DESC
    if($order == 1) $getOrder['order'] = "ASC";
    elseif( $order == 2) $getOrder['order'] = "DESC";
    else $getOrder['order'] = "DESC";

    // define order by which field
    if(!empty($by) ){
        if(array_key_exists($by, $fields) || array_search($by,$fields)){
            if (array_key_exists($by, $fields)){
                $getOrder['by'] = $fields[$by];
            }else{
                $getOrder['by'] =  $by;
            }
        }else $getOrder['by'] = $default;

    }else{
        $getOrder['by'] = $default;
    }

    return $getOrder;
}

/*****
 * segment()
 * Return uri segment. return default if not get.
 */

function segment($segment, $default = 0, $slash = ''){

    $getSegment = Request::segment($segment);

    if(!empty($getSegment))
        return $getSegment.$slash;
    else
        return $default.$slash;
}


/****
 * get_client_ip_env() get actual user ip/
 * return ip as string
 ***/
function get_client_ip_env() {

    $ipAddress = '';

    if (getenv('HTTP_CLIENT_IP'))
        $ipAddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipAddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipAddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipAddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipAddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipAddress;
}

/*****
 * show_404()
 * Page not found error. supported for CI 3
 */

function show_404(){
    return abort(404);
}

// Menu active class add
if (! function_exists('activeMenu')) {
    function activeMenu($sig, $data){
        return (Request::segment($sig) == $data)?'active':'';
    }
}
// Menu menu open class add
if (! function_exists('menuOpenActive')) {
    function menuOpenActive($sig, $data, $active=false){
        if (is_array($data)) {
            for ($x = 0; $x < count($data); $x++) {
                if (Request::segment($sig) == $data[$x]) {
                    if ($active) {
                        return 'active';
                    }else{
                        return 'menu-open';
                    }

                }
            }
        }else{
            return (Request::segment($sig) == $data)?'menu-open':'';
        }
    }
}

// Email Send
function emailSend($to, $subject, $data,$view='mail'){

    Mail::send('email.'.$view, $data, function ($message) use ($to, $subject){
        return $message->to($to)->subject($subject)->from('admin@gmail.com');
    });
}

function getHours($startDate, $endDate=''){
    if (empty($endDate)) {
        $endDate = date('Y-m-d H:i:s');
    }
    $star = strtotime($startDate);
    $end = strtotime($endDate);
    return round(($end-$star) / 3600);

}

// Day Calculation
function getDayByDate($startDate, $endDate){
    $star = strtotime($startDate);
    $end = strtotime($endDate);
    $day = round(($end - $star) / 86400);
    return (int)$day;
}

function dateFormat($date){
    if (!empty($date)) {
        $date = str_replace(['/','.'],['-'], $date);
        return date(config('settings')['date_format'], strtotime($date));
    }
}

function dbDateFormat($date){
    $date = str_replace(['/','.'],['-'], $date);
    $dateCheck = validateDate($date);
    if ($dateCheck) {
        return date('Y-m-d', strtotime($date));
    }
}
function validateDate($date)
{
    $timestamp = strtotime($date);
    return $timestamp ? $date : null;
}

function getUrlSlug($id,$title){
    $slug = Str::slug($title, '-');
    return $id.'-'.$slug;
}
function getSlugById($slug){
    $id = explode('-',$slug);
    return $id[0];
}

function moduleCheck($permission, $module){
    if (empty($permission)) {
        return true;
    }
    $permission = json_decode($permission, true);
    if (!isset($permission[$module])  ||  (isset($permission[$module]) && $permission[$module] == true)){
        return true;
    }
    return false;
}


function checkUncheck($id){
    if ($id !=dAuth()->getUser()->id){
        return true;
    }
    return false;
}


/**
 * Retrieve the value of a given field from the given data.
 *
 * @param  string  $field    The name of the field whose value needs to be retrieved
 * @param  mixed   $data     The data from which the value needs to be retrieved
 * @param  mixed   $default  The default value to be returned if the field does not exist in the data (optional, defaults to null)
 *
 * @return mixed  The value of the given field from the data or the default value if the field does not exist in the data.
 */
function getValue($field, $data, $default=null){
    return (!empty($data) && isset($data->$field)) ? old($field,$data->$field) : old($field,$default);
}

function lkc()
{
    if (\Request::getRequestUri() == '/api/v1/licenses-deactivate') {
        return true;
    }
    $url = \Request::getHttpHost();
    if (file_exists(storage_path() . '\app\uploads\licence_key.json')) {
        $hash = \Illuminate\Support\Facades\Hash::class;
        $path = storage_path() . '\app\uploads\licence_key.json';
        $json = json_decode(file_get_contents($path), true);
        if (isset($json['data']['license_key']) && (isset($json['data']['status']) && $json['data']['status'] == 1)) {
            $license = substr($json['data']['license_key'], 32);
            if ($hash::check($url, $license)) {
                return true;
            } else {
                unlink($path);
                exit('Bad Request!');
            }
        } else {
            exit('Bad Request!');
        }
    } else {
        $file = '\licence_key.json';
        $destinationPath = storage_path() . "\app\uploads";
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $ip = md5($url);
        $response = Http::get('https://license.visualsofts.com/api/v1/licenses', [
            'ip' => $ip,
            'date' => date('Y-m-d H:i:s')
        ]);
        $jsonData = $response->json();
        $data = json_encode($jsonData);
        if (isset($jsonData['data']['status']) && $jsonData['data']['status'] == 1) {
            File::put($destinationPath . $file, $data);
        } else {
            exit('Bad Request!');
        }
    }
}


function getFileInfo($file){
    $fileInfo =[
        "type" => "",
        "path" => "",
        "timestamp" => Null,
        "size" => Null,
        "dirname" => "",
        "basename" => "",
        "filename" => "",
        "extension" => "",
    ];

    if (!empty($file) && isset($file['path'])){
        $fileInfo =[
            "type" => $file['type'],
            "path" => $file['path'],
            "timestamp" => Null,
            "dirname" => trim(pathinfo(Storage::url($file['path']), PATHINFO_DIRNAME), Storage::url('/')),
            "basename" => pathinfo(Storage::url($file['path']), PATHINFO_BASENAME),
            "filename" => pathinfo(Storage::url($file['path']), PATHINFO_FILENAME),
            'extension' => ''
        ];
        if ($file['type'] =='file'){
            $fileInfo['extension'] = pathinfo(Storage::url($file['path']), PATHINFO_EXTENSION);
        }
    }
    return $fileInfo;
}


function getModuleName($className){
    $arr_class              = explode("\\", $className);
    return count($arr_class) >0?strtolower($arr_class[1]):'';
}

function getPlaceholderDate(){
    return str_replace(["Y",'d','m'],["YY",'DD','MM'],config('settings')['date_format']);
}

function getDataTablesInfo($allData, $serial, $c){
    $Showing = $allData->total()>0?$serial+1:0;
    $to = $c>0?$c+$serial-1:0;
    return 'Showing '.$Showing. ' to '.$to.' of '. $allData->total(). ' entries';
}


function successMessage($id='', $title=''){
    if (empty($id) && empty($title)){
        $title = 'Record';
    }
    return empty($id)?$title.' Successfully Created.':$title.' Successfully Updated';
}

function getLabelName($name){
   return ucwords(str_replace(['_id','_'],' ',$name));
}

function getArraySearchValue($needle, $column, $dataArray=''){
    if (empty($dataArray)) return false;
    $array = $dataArray->toArray();
    $haystack = array_column($array, $column);
    return in_array($needle, $haystack, TRUE)?$needle:'';
}

function getSelectedOption($value, $key, $objData, $default=''){
    return (getValue($key, $objData, $default) == $value)?'selected':'';
}

function getChecked($value, $key, $objData, $default=''){
    $default = !$objData?$default:'';
    return (getValue($key, $objData, $default) == $value)?'checked':'';
}
function getCheckedArraySearch($needle, $key, $dataArray=''){
    $id = getArraySearchValue($needle, $key, $dataArray);
    if (!empty(!$id)){
        $id = old($key);
        $id = $id[$needle]??'';
    }
    return ($id == $needle)?'checked':'';
}

function getStatusBadge($statuId){
    return $statuId !=1?'<span class="badge bg-danger">Inactive</span>':'<span class="badge bg-success">Active</span>';
}
