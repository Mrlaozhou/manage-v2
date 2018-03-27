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
        $roles       =   Role::with('privileges')->get();

        foreach ($roles as $role){
            dump($role->privileges);
        }

    }
}
