<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolyParam extends Model
{
    protected $guarded =[];
    public function parent()
    {
        return $this->morphTo();
    }
}
