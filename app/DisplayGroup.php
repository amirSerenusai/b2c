<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class DisplayGroup
 * @package App
 */
class DisplayGroup extends GroupModel
{
    use SoftDeletes;
    protected $guarded= [];
    protected $table = 'display_groups';

    /**
     * @return mixed
     */
    public function answerGroup()
    {

        return head(( head($this->answers() )  ) )->answerGroup() ;
    }



}
