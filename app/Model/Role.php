<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function getList()
    {
        return $this->orderBy('id', 'asc')->get();
    }
}
