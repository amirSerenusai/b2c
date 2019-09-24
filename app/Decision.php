<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Decision
 *
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string|null $deleted_at
 * @property int $is_deleted
 * @property string $title
 * @property string|null $description
 * @property int $is_indication
 * @property int $code
 * @property int $show_in_teach
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereIsIndication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereShowInTeach($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Decision whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Decision extends Model {
    
    protected $table = 'decision_codes';
    protected $fillable = [];
    protected $hidden = [];
    
}