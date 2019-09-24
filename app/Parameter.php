<?php
/**
 * Created by PhpStorm.
 * User: romangutkin
 * Date: 05/03/19
 * Time: 14:44
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Parameter
 * @package App
 */
class Parameter extends Model {

    use SoftDeletes;

    protected $table = 'client_params';

    protected $dates = [ 'deleted_at' ];

   // public $connection = 'local';

    protected $fillable = [
        'param_name',
        'param_value',
        'client_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client ()
    {

        return $this->belongsTo( Client::class, 'client_id' );
    }

    /**
     * @param $paramTitle
     * @return bool
     */

}
