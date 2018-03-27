<?php

namespace App\Http\Controllers;

use App\Models\RBAC\Admin;
use App\Models\RBAC\Mode;
use App\Models\RBAC\Privilege;
use App\Models\RBAC\Role;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index (Request $request)
    {
        // -- mode 测试

//        $test           =   Mode::first();
//
//        $test           =   Privilege::find('9A8428EF50AE935DC09B1791389D8AE9')->roles()->get();

//        $test           =   Role::first()->privileges()->get()->groupBy('type');

        $test           =   Admin::find('3F6F6A50BD91AC4572E24BAA879CB805')->roles()->get();

        dump($test);
    }
}
