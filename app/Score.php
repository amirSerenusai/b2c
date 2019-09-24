<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Procedure
 *
 * @method static Builder where( $column, $operator = null, $value = null, $boolean = 'and' )
 * @method static Builder find( int $id )
 * @method static Builder create( array $attributes = [] )
 * @method public Builder update( array $values )
 * @package App
 * @mixin Eloquent
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string|null $deleted_at
 * @property int $proc_id
 * @property int $score_from
 * @property int $score_to
 * @property string $created
 * @property string $modified
 * @property int $is_deleted
 * @property string $title
 * @property string $description
 * @property int $is_indication
 * @property int $decision_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereDecisionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereIsIndication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereProcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereScoreFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereScoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereUpdatedAt($value)
 */
class Score extends Model {

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [];

    /**
     * The associated DB table of this model.
     * @var string
     */
    protected $table = 'procedures_score';

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];

    public function procedure()
    {
        $this->belongsTo(Procedure::class, 'proc_id');
    }


}
