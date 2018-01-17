<?php
/**
 * Created by PhpStorm.
 * User: sokolskih
 * Date: 16.01.2018
 * Time: 17:33
 */

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

class SaveTest extends Facade{

    protected static function getFacadeAccessor()    {
        return 'myChatContainer';
    }
}
