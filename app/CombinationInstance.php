<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/** @noinspection PhpClassNamingConventionInspection */

/**
 * Class CombinationInstance
 * @property mixed questionnaires
 * @property mixed client_id
 * @package App
 * @method static |CombinationInstance find($id)
 * * @method static |CombinationInstance findOrFail($id)
 */
class CombinationInstance extends Model
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
    protected $fillable = ['combination_id', 'client_id' , 'patient_id'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function combination()
    {
        return $this->belongsTo(Combination::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * @return mixed
     */
    public function answered()
    {
        return $this->questionnaires();
    }

}