<?php

namespace App\Models\RBAC;

use App\Models\RBAC\Base as BaseModel;

class Role extends BaseModel
{
    //
    protected $table            =   'role';

    public function privileges ()
    {
        return $this->hasManyThrough(
            Privilege::class,
            Relation2::class,
            'ruuid' ,
            'uuid',
            'uuid',
            'puuid'
        )->select(...['name','type']);
    }

    public function admins ()
    {
        return $this->belongsToMany(
            Admin::class,
            'relation1',
            'ruuid',
            'auuid'
        )->select(...['username']);
    }
}
