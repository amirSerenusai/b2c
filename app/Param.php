<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Param extends Model {
    
    use SoftDeletes;
    
    protected $fillable = ['title', 'target', 'type','value'];
    
    protected $dates = ['deleted_at'];
    
    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'answer_param');
    }
}
