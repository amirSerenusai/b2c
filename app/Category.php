<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Category
 * @property int                                                            $id
 * @property \Carbon\Carbon|null                                            $updated_at
 * @property \Carbon\Carbon                                                 $created_at
 * @property string|null                                                    $deleted_at
 * @property string                                                         $title
 * @property string                                                         $created
 * @property string                                                         $modified
 * @property int                                                            $is_deleted
 * @property string|null                                                    $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Procedure[] $procedures
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreated( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDeletedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDescription( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsDeleted( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereModified( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereTitle( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class Category extends Model {
    
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $table = 'cat';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [];
    
    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [];
    
    public function procedures()
    {
        return $this->hasMany(Procedure::class, 'cat_id');
    }

    public function combinations()
    {
        return $this->hasMany(Combination::class, 'cat_id');
    }
}
