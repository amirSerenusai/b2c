<?php

namespace App;
use Log;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\AnswerHelper;
/**
 * App\Answer
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder find(int $id)
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 * @property-read mixed $indication
 * @property-read mixed $tag
 * @property-read Question $question
 * @property-read Collection|Questionnaire[] $tests
 * @mixin Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string|null $deleted_at
 * @property int $question_id
 * @property string|null $title
 * @property string|null $answer_groups
 * @property int|null $weight
 * @property string|null $weight_formula
 * @property int|null $next_question_id
 * @property int|null $priority
 * @property string|null $created
 * @property string|null $modified
 * @property int|null $is_deleted
 * @property int|null $end_test
 * @property string|null $keys_for_end_test
 * @property string|null $end_test_text
 * @property string|null $justification
 * @property string|null $auto_keys
 * @property int|null $force_score
 * @property string|null $notes
 * @property int|null $vas_min
 * @property int|null $vas_max
 * @property float|null $vas_min_display
 * @property float|null $vas_max_display
 * @property float|null $vas_step
 * @property string|null $vas_auto_answer_formula
 * @property string|null $vas_explanation
 * @property string|null $keys_for_showing_answer
 * @property string|null $keys_for_showing_answer_teach
 * @property int|null $vas_dont_show_no
 * @property int|null $vas_dont_show_unknown
 * @property int|null $vas_min_teach
 * @property int $vas_max_teach
 * @property int|null $vas_min_display_teach
 * @property int|null $vas_max_display_teach
 * @property mixed $pivot
 * @property array $display_groups
 * @method static Builder|Questionnaire findOrFail($id)
 */
class Answer extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'weight', 'tag', 'end_test', 'keys_for_end_test', 'notes', 'indication', 'display_groups'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function helper()
    {
        return $this->hasOne('App\AnswerHelper', 'answer_id', 'id');
    }
    public function tests()
    {
        return $this->belongsToMany(Questionnaire::class, 'tests_answers')->withTimestamps();
    }

    public function isVas()
    {
        if ((empty($this->vas_min_display) && empty($this->vas_max_display))) {
            return false;
        }

        return (!empty($this->vas_min))
            or (!empty($this->vas_max))
            or (!empty($this->vas_min_display))
            or (!empty($this->vas_max_display));
    }

    public function isVasPositive($sub_answer)
    {
        return ($this->isVas() && $sub_answer != '_no' && $sub_answer != '_unknown');
    }

    public function getTagAttribute($value)
    {
        if (!$value) {
            return [];
        }

        return collect(explode(',', $value))->map(function ($key) {
            return preg_match('/:/', $key) ? preg_replace('/:.+/', '', $key) : $key;
        });
    }

    public function getIndicationAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function getDisplayGroupsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function getDisplayGroupsStringAttribute($value)
    {
        return $value;
    }

    public function getVasIntermediateScoreAttribute($value)
    {
        return $value ? json_decode($value, true) : $value;
    }

    public function getVasIntermediateDisplayAttribute($value)
    {
        return $value ? json_decode($value, true) : $value;
    }

    public function getAnswerGroupsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function getVasMinDisplayAttribute($value)
    {
        //        return $value != null ? (int)$value : $value;
        return $value != null  ?  number_format($value,2) : $value;
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $value
     * @return string
     */
    public function getVasMaxDisplayAttribute($value)
    {

        if(is_string($value)) return $value;
        //return $value != null  ? (int)$value : $value;
//        info("val". $value != null  ?  number_format($value,2) : $value);
        return $value != null  ?  number_format($value,2) : $value;

    }

    public function getVasStepAttribute($value)
    {
        //return (int)$value ?: 1;
        return !$value ? 1 : $value ;
    }

    public function createdKeys()
    {
        return (!empty($this->tag[0])) ? $this->tag[0] : "";
    }

    public function params()
    {
        return $this->belongsToMany(Param::class, 'answer_param')->withPivot('value');
    }
    public function answerParam()
    {
        $p= $this->belongsToMany(Param::class, 'answer_param')->withPivot('value');
        return $p;
    }

    /**
     * @param $paramTitle
     * @return bool
     */
    public function getParam($paramTitle){

        foreach($this->params as $param){
            if ($param->title == $paramTitle)
                return $param->pivot->value;
        }
        return false;
    }

    /**
     * @param $my_text
     * @return false|int
     */
    public function parseAnswerVas($my_text)
    {


//        return $my_text;
//        return  starts_with('@asdasd', '@' );
        preg_match ("/^(@\w+)/", '@expression @ss ff #D @ss ff' ,$matches);
        return $matches;
        //return  starts_with($my_text, '@' );
    }

    /**
     * @return bool
     */
    public function displayGroup()
    {
        if (empty($this->display_groups)) return false;

        return $this->question->displayGroups()->where('name', 'like', $this->display_groups )->first(); //->where('name','like', $this->display_groups );

    }

    /**
     * @return bool
     */
    //public function answerGroup()
    //{
    //    if (empty($this->answer_groups)) return false;
    //
    //    return $this->question->answerGroups()->where('name', 'like', $this->answer_groups )->first(); //->where('name','like', $this->answer_groups );
    //
    //}

    public function answerGroups()
    {
        if (empty($this->answer_groups)) return false;
        return $this->question->answerGroups()->whereIn('name', $this->answer_groups )->get(); //->where('name','like', $this->answer_groups );
    }


}
