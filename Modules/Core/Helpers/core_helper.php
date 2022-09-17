<?php


/*****
 * currency()
 * Return currency format.
 */

function currency($amount, $format = false, $symbole=true){

    $s_symbole = Config::get('settings.c_symbol');
    if (!$symbole) {
        $s_symbole='';
    }
    if(Config::get('settings.c_order') === 'left'){
        if($format) return $s_symbole.' '.number_format((float) $amount, 2, '.', ',');
        else return $s_symbole.' '.floatval($amount);

    }else{
        if($format) return number_format((float) $amount, 2, '.', ',').' '.$s_symbole;
        else return floatval($amount).' '.$s_symbole;
    }
}




function getResourceRoute($controller, $array=''){
    $route =  Illuminate\Support\Facades\Route::class;
    for ($i=0; $i<count($array); $i++) {
        switch ($array[$i]) {
            case "index":
                $route::match(['get', 'post'], '/', [$controller,'index'])->name('');
                break;
            case "store":
                $route::post('/store', [$controller,'store'])->name('.store');
                break;
            case "create":
                $route::get('/create', [$controller,'create'])->name('.create');
                break;
            case "edit":
                $route::get('/{id}/edit', [$controller,'edit'])->name('.edit');
                break;
            case "update":
                $route::post('/update', [$controller,'update'])->name('.update');
                break;
            case "show":
                $route::get('/{id}', [$controller,'show'])->name('.show');
                break;
            case "delete":
                $route::match(['get', 'post'], '/delete/{id}', [$controller,'destroy'])->where(['id' => '[0-9]+'])->name('.delete');
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
        echo '<div class="alert alert-danger"><ul>';
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
    $order = Request::get('order') ?? 2; // OrderStatus asc or desc;
    $by = Request::get('by'); // by field name;

    //define ASC or DESC
    if($order == 1) $getOrder['order'] = "ASC";
    elseif( $order == 2) $getOrder['order'] = "DESC";
    else $getOrder['order'] = "DESC";

    // define order by which field
    if(!empty($by) ){
        if(array_key_exists($by, $fields)){
            $getOrder['by'] = $fields[$by];
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
if (! function_exists('menuOpen')) {
    function menuOpen($sig, $data){
        return (Request::segment($sig) == $data)?'menu-open':'';
    }
}

// Email Send
function emailSend($to, $subject, $data,$view='mail'){

    Mail::send('email.'.$view, $data, function ($message) use ($to, $subject){
        return $message->to($to)->subject($subject)->from('hotel@gov.bd');
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
    if ($id !=Sentinel::getUser()->id){
        return true;
    }
    return false;
}

function getValue($field, $data, $default=null){
    return (!empty($data) && !empty($data->$field)) ? old($field,$data->$field) : old($field,$default);
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


