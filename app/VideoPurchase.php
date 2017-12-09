<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPurchase extends Model
{
    //
    protected $fillable = [
        'video_id', 'purchaser_id', 'performer_id', 'purchased_credits',
        'performer_credits', 'club_credits', 'ServiceProvider_credits',
        'unique_id'
    ];

    public function video(){
        return $this->belongsTo('App\Video');
    }
}
