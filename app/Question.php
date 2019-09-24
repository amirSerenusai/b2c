<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Question
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder find(int $id)
 * @method static Builder create(array $attributes = [])

 * @method public Builder update(array $values)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read mixed $indication
 * @property-read \App\Procedure $procedure
 * @mixin /Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string|null $deleted_at
 * @property string|null $title
 * @property int $proc_id
 * @property string|null $created
 * @property string|null $modified
 * @property int|null $is_deleted
 * @property int|null $is_multiple
 * @property string|null $tag
 * @property string|null $tag_teach
 * @property int $priority
 * @property string|null $justification
 * @property int|null $is_auto
 * @property string $title_doctor
 * @property int|null $vas_max
 * @property int|null $vas_min
 * @property int|null $min_score
 * @property int|null $max_score
 * @property string|null $question_type
 * @property int|null $is_general
 * @property string|null $answers_type
 * @property float|null $numric_min_range
 * @property float|null $numric_max_range
 * @property array|mixed|null $question_tag
 * @property int|null $vas_min_display
 * @property int|null $vas_max_display
 * @property int|null $vas_step
 * @property string|null $ignore_if_keys_exist
 * @property int|null $teach_max_answers
 * @property string|null $vas_auto_answer_formula
 * @property int|null $vas_min_teach
 * @property int|null $vas_max_teach
 * @property int|null $vas_min_display_teach
 * @property int|null $vas_max_display_teach
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Questionnaire[] $tests
 * @method static Builder|Questionnaire findOrFail($id)
 * @method Questionnaire sortByDesc($priority)

 *
 *
 */
class Question extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['tag', 'title_doctor', 'proc_id', 'priority', 'is_auto', 'indication','title'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'proc_id');
    }

    /**
     * @return HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class)->where('is_deleted', 0)->orderByDesc('priority');
    }
    public function ansParams()
    {
        return $this->answers()->with('answerParam');
    }
    public function answersWithParams()
    {
        return $this->answers()->with('params:title,value');
        //array_pluck('title','value');
    }
    public function pluckAnsParams()
    {
        $ansParams=$this->ansParams->map(function($item) {
            // if (!empty($item->toArray()['answer_param'] ) ){
            $array = $item->toArray()['answer_param'];
            $array=array_pluck($array, 'pivot.value','title');

            foreach ($array as $key => $value) {
                $item[$key]=$value;
            }

            return   $array ;
        });



        return $ansParams;
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $answers
     * @param Question $question
     * @return array
     */
    public function getAnswersWithParams($answers) {

        $zipped=[];

        foreach ($answers as  $key => $item)
        {

            $item=$item->toArray();
            $item = array_merge($item, $this->pluckAnsParams()[$key]);
            $zipped[]=$item;
        }

        return $zipped;
    }

    /**
     * @return MorphMany
     */
    public function polyParams()
    {
        return $this->morphMany(PolyParam::class,'parent');
    }

    /**
     * @return BelongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Questionnaire::class, 'tests_answers')->withTimestamps();
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function getIndicationAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    /**
     * @param $paramTitle
     * @return bool
     */
    public function getParam($paramTitle) {

        foreach($this->polyParams as $param){
            if ($param->title == $paramTitle)
                return $param->value;
        }
        return false;
    }
    /**
     * @param $value
     *
     * @return array|mixed|null
     */
    public function getQuestionTagAttribute($value)
    {
        if (!$value) {
            return [];
        }

        return collect(explode(',', $value))->map(function ($key) {
            return preg_match('/:/', $key) ? preg_replace('/:.+/', '', $key) : $key;
        });
    }

    public function firstAnswer()
    {
        return $this->answers->first();
    }

    public function lastAnswer()
    {
        return $this->answers->last();
    }

    /**
     * @return HasMany
     */
    public function displayGroups()
    {
        return $this->hasMany(DisplayGroup::class);
    }

    /**
     * @return HasMany
     */
    public function answerGroups()
    {

        return $this->hasMany(AnswerGroup::class);
    }
}

