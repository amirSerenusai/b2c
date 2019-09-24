<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class GroupModel
 * @property mixed name
 * @property mixed question
 * @package App
 * @method where(string $string, $name)
 */
class GroupModel extends Model
{
    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    /**
     * @return mixed
     */
    public function answers()
    {

        return $this->question->answers()->select('answer_groups','display_groups','id','question_id')->where($this->table,'like' , $this->name)->get();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findOrCreate($name)
    {

        return $this->where('name', $name)->get()->empty;
    }
}
