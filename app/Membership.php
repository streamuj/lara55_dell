<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //
    protected $fillable = [
        'user_id',
        'type',
        'start_date',
        'end_date',
        'subscription_id',
        'transaction_id',
        'level'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
