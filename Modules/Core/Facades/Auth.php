<?php

namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Modules\Core\Repositories\AuthRepository';
    }

}
