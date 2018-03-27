<?php

namespace App\Models\RBAC;

use App\Models\RBAC\Base as BaseModel;

class Admin extends BaseModel
{
    //
    protected $table            =   'admin';

    public function roles ()
    {
        return $this->hasManyThrough(
            Role::class,
            Relation1::class,
            'auuid',
            'uuid',
            'uuid',
            'auuid'
        )->select(...['name']);
    }

    public function scopeRoot ($query)
    {
        return $query->where( 'uuid', env('ROOT') );
    }
}
