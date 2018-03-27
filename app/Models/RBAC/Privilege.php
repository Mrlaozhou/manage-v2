<?php

namespace App\Models\RBAC;

use App\Models\RBAC\Base as BaseModel;

class Privilege extends BaseModel
{
    //
    protected $connection           =   'rbac';

    protected $table                =   'privilege';


    /**@ 权限所对模式
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode ()
    {
        return $this->hasOne( Mode::class,'uuid','mode' )
            ->select(...['name','sign']);
    }

    /**
     * @拥有此权限的角色
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function roles ()
    {
        return $this->hasManyThrough(
            Role::class,
            Relation2::class,
            'puuid',
            'uuid',
            'uuid',
            'ruuid'
        )->select(...['name']);
    }
}
