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
    public function modes ()
    {
        return $this->belongsTo(
            Mode::class,
            'mode',
            'uuid'
        );
    }

    /**
     * @拥有此权限的角色
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function roles ()
    {
        return $this->belongsToMany(
            Role::class,
            'relation2',
            'puuid',
            'ruuid'
        )->select(...['name','sign']);
    }
}
