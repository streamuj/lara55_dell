<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'length',
        'path',
        'thumbnail',
        'is_paid',
        'is_vr',
        'is_public'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function performerProfile(){
        return $this->belongsTo('App\PerformerProfile', 'user_id', 'user_id');
    }
    public function videosPurchase(){
        return $this->hasMany('App\VideoPurchase');
    }
}

