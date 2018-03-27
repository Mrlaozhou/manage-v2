<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

}
