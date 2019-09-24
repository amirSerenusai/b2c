<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 *
 * @package App
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string $client_name
 * @property string $created
 * @property string $modified
 * @property bool $is_deleted
 * @property string $client_code
 * @property string $send_report_emails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CombinationInstance[] $combinationInstances
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Combination[] $combinations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Parameter[] $params
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Test[] $tests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Client onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereClientCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client find($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereSendReportEmails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model {

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'client_name',
        'client_code',
        'send_reports_email',
    ];


    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function params()
    {
        return $this->hasMany(Parameter::class);
    }

    /**
     * @return HasMany
     */
    public function combinations()
    {
        return $this->hasMany(Combination::class);
    }

    /**
     * @return HasMany
     */
    public function combinationInstances()
    {
        return $this->hasMany(CombinationInstance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tests()
    {
        return $this->hasManyThrough(Test::class, CombinationInstance::class);
    }

    public static function list()
    {
        return static::all()->keyBy('id')->map->client_name;
    }

    /**
     * @param $param_name
     * @return bool
     */
    public function getParam($param_name){

        foreach($this->params as $param){
            if ($param->param_name == $param_name)
               return $param->param_value;
        }
        return false;
    }
}
