<?php

namespace App;

use  App\Queries\Indications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpParser\Builder;

/**
 * Class Procedure
 * @package App
 * @method static where(string $string, int $title)
 * @method static find($id)
 */
class Procedure extends Model
{



    //use  Traits\TrackChangeTrait;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function displayGroups()
    {
        return $this->hasMany(DisplayGroup::class);
    }

    public function answerGroups()
    {
        return $this->hasMany(AnswerGroup::class);
    }

    public function polyParams()
    {
        return $this->morphMany(PolyParam::class,'parent');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'proc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function scores()
    {
        return $this->hasMany(ProcedureScores::class, 'proc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany(Test::class, 'proc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->select(['id', 'client_id']);
    }

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'cat_id',
        'priority',
        'short_desc',
        'general_text',
        'indications_text',
        'recovery_text',
        'risks_text',
        'alternative_text',
        'is_preliminary',
        'version',
        'icd_code',
        'abbreviation',
        'is_ready',
    ];

    /**
     * @return bool
     */
    public function duplicate()
    {
        return $this->replicate()->save();
    }

    /**
     * @param $query
     *
     * @return int
     */
    public function categoryId()
    {
        return $this->category->id;
    }

    /**
     * @return string
     */
    public function firstQuestionTitle()
    {
        return $this->questions()->first()->title;
    }

    /**
     * @return string
     */
    public function firstAnswerTitle()
    {
        return $this->questions()->first()->answers()->first()->title;
    }

    /**
     * @return string
     */
    public function firstScoreTitle()
    {
        return $this->scores()->first()->title;
    }

    public function firstQuestionAnswersCount()
    {
        return $this->questions()->first()->answers()->count();
    }
    public function pluckClient($procedures)
    {
        return  $procedures->map(function ($item, $key)   {
            $item['users']= array_get($item['users']->toArray(),'0.client_id');
            return $item;
        });
    }

    public function getIndications()
    {
        $newIndications =  new Indications($this->id);

        return  $newIndications-> get();
    }

    public function indicationSiblingsKeys($procedures_keys = null)
    {
        //dd(request()->all());
        //Todo  get all indications from all of the combinations that include this Procedure.
        //*1.Grab all Indications:
        return $this
            ->select('id')
            ->whereIn('title', $procedures_keys )
            ->get()
            ->map(function ($proc) {
                return $proc -> getIndications();
            })  //*2.filter duplicate:
            ->collapse()
            ->filter(function($ind) {return  !Str::startsWith($ind, '*'); })
            ->unique() ;
        //*3.merge them to score keys:

    }
    public function getIDs($titles) {
        if (!$titles) return [$this->id];
        return $this->WhereIn('title',$titles)->pluck('id');
    }

    public function keys()
    {
        $questions = Question::where('proc_id', $this->id)
            ->where('is_deleted', 0)
            ->whereNull('deleted_at')
            ->select('id', 'question_tag', 'is_deleted')
            ->with(['answers' => function ($query) {
                $query->where('is_deleted', 0)
                    ->whereNull('deleted_at')
                    ->select('id', 'question_id', 'tag','display_groups'); // DISPLAY GROUPS NEW
            }])
            ->get();
        // join all the keys together.
        //info( print_r($questions->flatMap->answers->map->display_groups->flatten()->transform(function($a){return "#".$a;}), true) );
        return $questions->flatMap->answers->map->tag
            ->merge($questions->map->question_tag)
            ->merge($questions->flatMap->answers->map->display_groups->flatten()->transform(function($a){return "#".$a;})) //NEW
            ->flatten()
            ->filter()
            ->reduce(function ($carry, $item) {
                $carry[$item] = '_void';

                $carry[$item . ' exists'] = " @{$item} != _void && @{$item} != _unknown ";

                return $carry;
            }, new Collection)
            ->sortByDesc(function ($value, $key) {
                return strlen($key);
            });
    }

    public function indications()
    {
        $questions = Question::where('proc_id', $this->id)
            ->where('is_deleted', 0)
            ->whereNull('deleted_at')
            ->select('id', 'indication', 'is_deleted')
            ->with(['answers' => function ($query) {
                $query->where('is_deleted', 0)
                    ->whereNull('deleted_at')
                    ->select('id', 'indication');
            }])
            ->get();

        return $questions->flatMap->answers->map->indication
            ->merge($questions->map->indication)
            ->flatten()
            ->filter()
            ->reduce(function ($carry, $item) {
                $carry[$item] = '_void';

                return $carry;
            }, new Collection);
    }
}
