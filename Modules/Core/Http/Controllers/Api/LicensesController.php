<?php

namespace Modules\Core\Http\Controllers\Api;


use Illuminate\Routing\Controller;



class LicensesController extends Controller
{

    public function licensesDeactivate(){
        if(file_exists( storage_path().'\app\uploads\licence_key.json')) {
            $path = storage_path().'\app\uploads\licence_key.json';
            unlink($path);
            return redirect('https://license.visualsofts.com/licenses');
        }else {
            return redirect('https://license.visualsofts.com/licenses');
        }
    }


}
