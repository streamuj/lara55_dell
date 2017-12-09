<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsChat extends Model
{
    //
    protected $fillable = [
        'user_id','message','is_system','is_public'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
