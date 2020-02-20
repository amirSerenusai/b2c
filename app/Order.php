<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id' ,'proc_id' ,'comb_id' ,'paypal_id' ,'amount','tests_left' ,'tests_paid','expires_at' ];

}
