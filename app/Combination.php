<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Combination
 * @package App
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Combination select($value)
 */

class Combination extends Model
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
    protected $fillable = ['title'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }/** @noinspection PhpMethodNamingConventionInspection */

    /**
     * @param $value
     * @return array
     */
    public function getProceduresAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function combinationInstances()
    {
        return $this->hasMany(CombinationInstance::class);
    }

    /**
     * @param $title
     * @return mixed
     */
    public function procSiblingsKeys($title)
    {
        return self::select('procedures')
            ->where('procedures', 'like', '%'.$title.'%')
            ->get()
            ->pluck ('procedures')
            ->map ( function($a) {
            if(is_array ($a)) return $a;
                return explode(',', $a); })
            ->collapse()
            ->unique();

    }
}